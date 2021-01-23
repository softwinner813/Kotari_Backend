<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Room;
use App\Image;
use App\House;
use App\HouseFilter;


class ApiController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /***********************************************
     * @Auth: SoftWinner
     * @Date: 2020.10.5
     * @Desc: Api for mobile app
     */

    

    //=============== Get House List
    public function getHouseList(Request $req) {
        $houses = House::where('visible', 1)->paginate(10);
        foreach ($houses as $key => $house) {
            $house->images = $house->images;
            $rooms = $house->rooms;
            foreach ($rooms as $key => $room) {
                $room->images = $room->images;
            }
            $house->rooms = $rooms;
            $house->price = $house->rooms->min('cur_price');   
        }
        $data = array(
            'houses' => $houses,
        );
        return json_encode($data);
    }



    //=============== Get Room List
    public function getRoomList(Request $req) {
        $rooms = Room::paginate(10);
        foreach ($rooms as $key => $room) {
            $room->images = $room->images;
        }
        return json_encode($rooms);
    }

    //============= houseFilter ============
    public function houseFilter(Request $req) {

        // $houses = HouseFilter::get();
        // var_dump($houses[0]->rooms[0]->name);die();

        $island = ($req->island == 'none') ? '' : $req->island;

        $minBudget = $req->minBudget;
        $maxBudget = $req->maxBudget;

        $houses = HouseFilter::where('island','like', '%'.$island)->where('visible', 1);
        $houses = (isset($req->minBudget) && isset($req->maxBudget) ) ? $houses->where('price','>',$minBudget)->where('price','<',$maxBudget) : $houses;
        

        // House Services
        $houses = (isset($req->house_internet)) ? $houses->where('internet',1) : $houses;
        $houses = (isset($req->house_restaurant)) ? $houses->where('restaurant',1) : $houses;
        $houses = (isset($req->house_bar)) ? $houses->where('bar',1) : $houses;
        $houses = (isset($req->house_room_service)) ? $houses->where('room_service',1) : $houses;
        $houses = (isset($req->house_breakfast)) ? $houses->where('breakfast',1) : $houses;
        $houses = (isset($req->house_front_desk)) ? $houses->where('front_desk',1) : $houses;
        $houses = (isset($req->house_kid)) ? $houses->where('kid',1) : $houses;
        $houses = (isset($req->house_pool)) ? $houses->where('pool',1) : $houses;
        $houses = (isset($req->house_park)) ? $houses->where('park',1) : $houses;
        $houses = (isset($req->house_fitness)) ? $houses->where('fitness',1) : $houses;
        $houses = (isset($req->house_beach)) ? $houses->where('beach',1) : $houses;
        $houses = (isset($req->house_air)) ? $houses->where('air',1) : $houses;
        $houses = (isset($req->house_hot)) ? $houses->where('hot',1) : $houses;
        $houses = (isset($req->house_spa)) ? $houses->where('spa',1) : $houses;
        $houses = (isset($req->house_laundry)) ? $houses->where('laundry',1) : $houses;
        $houses = (isset($req->house_tv)) ? $houses->where('tv',1) : $houses;
        $houses = (isset($req->house_smoke)) ? $houses->where('smoke',1) : $houses;


        // Facility
        $houses = (isset($req->facility_internet)) ? $houses->where('f_internet',1) : $houses;
        $houses = (isset($req->facility_restaurant)) ? $houses->where('f_restaurant',1) : $houses;
        $houses = (isset($req->facility_bar)) ? $houses->where('f_bar',1) : $houses;
        $houses = (isset($req->facility_room_service)) ? $houses->where('f_room_service',1) : $houses;
        $houses = (isset($req->facility_breakfast)) ? $houses->where('f_breakfast',1) : $houses;
        $houses = (isset($req->facility_front_desk)) ? $houses->where('f_front_desk',1) : $houses;
        $houses = (isset($req->facility_kid)) ? $houses->where('f_kid',1) : $houses;
        $houses = (isset($req->facility_pool)) ? $houses->where('f_pool',1) : $houses;
        $houses = (isset($req->facility_park)) ? $houses->where('f_park',1) : $houses;
        $houses = (isset($req->facility_fitness)) ? $houses->where('f_fitness',1) : $houses;
        $houses = (isset($req->facility_beach)) ? $houses->where('f_beach',1) : $houses;
        $houses = (isset($req->facility_air)) ? $houses->where('f_air',1) : $houses;
        $houses = (isset($req->facility_hot)) ? $houses->where('f_hot',1) : $houses;
        $houses = (isset($req->facility_spa)) ? $houses->where('f_spa',1) : $houses;
        $houses = (isset($req->facility_laundry)) ? $houses->where('f_laundry',1) : $houses;
        $houses = (isset($req->facility_tv)) ? $houses->where('f_tv',1) : $houses;
        $houses = (isset($req->facility_smoke)) ? $houses->where('f_smoke',1) : $houses;
       
        switch ($req->sort) {
            case 'best':
                $houses = $houses->orderByDesc('created_at');
                break;

            case 'highPrice':
                $houses = $houses->orderByDesc('price');
                break;


            case 'lowPrice':
                $houses = $houses->orderBy('price','asc');
                break;
            
            default:
                # code...
                break;
        }
        // $houses = $houses->orderByDesc('created_at');
        $houses = $houses->paginate(10);

        foreach ($houses as $key => $house) {
            $house->images = $house->images;

            $rooms = $house->rooms;
            foreach ($rooms as $key => $room) {
                $room->images = $room->images;
            }
            $house->rooms = $rooms;

        }
        $data = array(
            'houses' => $houses,
        );
        return json_encode($data);
    }



    //============= roomFilter ============
    public function roomFilter(Request $req) {
        
        // var_dump($island);die();
        $minBudget = $req->minBudget;
        $maxBudget = $req->maxBudget;
        $room_offer = $req->room_offer;

        $facility = $req->facility;

        $rooms = Room::where('house_id',$req->house_id)->where('visible', 1);
        $rooms = (isset($req->minBudget) && isset($req->maxBudget) ) ? $rooms->whereBetween('cur_price', array($minBudget,$maxBudget)) : $rooms;
        

        switch ($req->sort) {
            case 'best':
                $rooms = $rooms->orderByDesc('created_at');
                break;

            case 'highPrice':
                $rooms = $rooms->orderByDesc('cur_price');
                break;


            case 'lowPrice':
                $rooms = $rooms->orderBy('cur_price','asc');
                break;
            
            default:
                # code...
                break;
        }
        $count = $rooms->count();
        $rooms = $rooms->paginate(5);
        foreach ($rooms as $key => $room) {
            $room->images = $room->images;
        }

        // var_dump($rooms);die();
        $data = array(
            'rooms' => $rooms,
            'count' => $count
        );
        return json_encode($data);
    }



    /****************************
     * @data : 2020.10.21 (version2)
     * 
     ***************************/
    function nameSearch(Request $req) {
        $value = $req->value;
        // var_dump($value);die();
        $houses = House::where('name','like', '%'.$value.'%')->orWhere('island','like', '%'.$value.'%')->where('visible', 1)->paginate(10);
        // house
        foreach ($houses as $key => $house) {
            $house->images = $house->images;
            $rooms = $house->rooms;
            foreach ($rooms as $key => $room) {
                $room->images = $room->images;
            }
            $house->rooms = $rooms;
            $house->price = $house->rooms->min('cur_price');     
        }
        
        $data = array(
            'houses' => $houses,
        );
        return json_encode($data);
    }
}
