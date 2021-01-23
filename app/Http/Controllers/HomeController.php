<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Room;
use App\Image;
use App\House;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $letters = ['a','b','c','d','f','g','h','i','g','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];

        $data = $this->file_get_contents_curl('https://id8tr.com/DEV/get12.php?term=d');
        // var_dump();die();
        $data = json_decode($data);

        foreach ($letters as $key => $letter) {
            # code...
            $path = 'net/'.$letter;
            if(!file_exists($path)) {
                mkdir($path);
            }

            foreach ($data as $key => $img) {
                if(strtoupper($letter) == $img->letter) {
                    $url = 'https://id8tr.com/DEV/images/'.$img->image_name;
                    $imgpath = $path.'/'.$img->image_name;
                    try {
                     $this->saveImg($url,$imgpath);   
                    } catch (Exception $e) {
                    }
                }
                # code...
            }
        }
        


        var_dump('successfully');die();
        return redirect('/admin');
        // return view('admin/addRoom');
    }

    function saveImg($url,$path) {
        // Function to write image into file 
        file_put_contents($path, file_get_contents($url)); 
        echo("downloaded");
    }

    function file_get_contents_curl($url) { 
        $ch = curl_init(); 
      
        curl_setopt($ch, CURLOPT_HEADER, 0); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_URL, $url); 
      
        $data = curl_exec($ch); 
        curl_close($ch); 
      
        return $data; 
    } 

    public function dashboard(Request $req) {
        $total_house = House::get();
        $visible_house = House::where('visible', 1)->get();
        $unvisible_house = House::where('visible', 0)->get();


        $total_rooms = Room::get();
        $visible_rooms = Room::where('visible', 1)->get();
        $unvisible_rooms = Room::where('visible', 0)->get();

        $data = array(
            'total_house' => $total_house,
            'visible_house' => $visible_house,
            'unvisible_house' => $unvisible_house,

            'total_rooms' => $total_rooms,
            'visible_rooms' => $visible_rooms,
            'unvisible_rooms' => $unvisible_rooms
        );
        return view('admin/dashboard')->with($data);
    }


    /************************************
     * Add House
     *
     *************************************/
    public function addHouse(Request $req) {
        return view('admin/addHouse');
    }

    public function addHousePost(Request $req) {
        $id = isset($req->id) ? $req->id : 0; 

        if(!$id) {
            if(is_null($req->file('images')) ) {
                $res = array(
                    'status' => 300,
                    'message' => 'No file selected!'
                );
                return json_encode($res);
            }

            $exist = House::where('name', $req->name)->first();
            if(!is_null($exist) ) {
                $res = array(
                    'status' => 300,
                    'message' => 'House name is already exist!'
                );
                return json_encode($res);
            }

        }

        $house = ($id) ? House::find($id) : new House;
        $house->name = $req->name;
        $house->desc = $req->desc;
        $house->island = $req->island;
        $house->email = $req->email;
        $house->phone = $req->phone;
        $house->address = $req->address;

        $house_offer = $req->house_offer;
        $facility = $req->facility;

        // Room Offers

        $house->internet = (is_null($house_offer)) ? 0 : ((in_array('internet', $house_offer)) ? 1: 0);
        $house->pool = (is_null($house_offer)) ? 0 : ((in_array('pool', $house_offer)) ? 1: 0);
        $house->fitness = (is_null($house_offer)) ? 0 : ((in_array('fitness', $house_offer)) ? 1: 0);
        $house->park = (is_null($house_offer)) ? 0 : ((in_array('park', $house_offer)) ? 1: 0);
        $house->restaurant = (is_null($house_offer)) ? 0 : ((in_array('restaurant', $house_offer)) ? 1: 0);

        $house->breakfast = (is_null($house_offer)) ? 0 : ((in_array('breakfast', $house_offer)) ? 1: 0);
        $house->kid = (is_null($house_offer)) ? 0 : ((in_array('kid', $house_offer)) ? 1: 0);
        $house->pet = (is_null($house_offer)) ? 0 : ((in_array('pet', $house_offer)) ? 1: 0);
        $house->air = (is_null($house_offer)) ? 0 : ((in_array('air', $house_offer)) ? 1: 0);

        $house->room_service = (is_null($house_offer)) ? 0 : ((in_array('room_service', $house_offer)) ? 1: 0);
        $house->front_desk = (is_null($house_offer)) ? 0 : ((in_array('front_desk', $house_offer)) ? 1: 0);
        $house->beach = (is_null($house_offer)) ? 0 : ((in_array('beach', $house_offer)) ? 1: 0);
        $house->hot = (is_null($house_offer)) ? 0 : ((in_array('hot', $house_offer)) ? 1: 0);
        $house->spa = (is_null($house_offer)) ? 0 : ((in_array('spa', $house_offer)) ? 1: 0);
        $house->laundry = (is_null($house_offer)) ? 0 : ((in_array('laundry', $house_offer)) ? 1: 0);
        $house->tv = (is_null($house_offer)) ? 0 : ((in_array('tv', $house_offer)) ? 1: 0);
        $house->smoke = (is_null($house_offer)) ? 0 : ((in_array('smoke', $house_offer)) ? 1: 0);
        $house->bar = (is_null($house_offer)) ? 0 : ((in_array('bar', $house_offer)) ? 1: 0);
        

        // Facilities
        $house->f_internet = ((is_null($facility)) ? 0 : ((in_array('internet', $facility)) ? 1: 0));
        $house->f_pool = ((is_null($facility)) ? 0 : ((in_array('pool', $facility)) ? 1: 0));
        $house->f_bar = ((is_null($facility)) ? 0 : ((in_array('bar', $facility)) ? 1: 0));
        $house->f_fitness = ((is_null($facility)) ? 0 : ((in_array('fitness', $facility)) ? 1: 0));
        $house->f_park = ((is_null($facility)) ? 0 : ((in_array('park', $facility)) ? 1: 0));
        $house->f_restaurant = ((is_null($facility)) ? 0 : ((in_array('restaurant', $facility)) ? 1: 0));

        $house->f_breakfast = ((is_null($facility)) ? 0 : ((in_array('breakfast', $facility)) ? 1: 0));
        $house->f_kid = ((is_null($facility)) ? 0 : ((in_array('kid', $facility)) ? 1: 0));
        $house->f_pet = ((is_null($facility)) ? 0 : ((in_array('pet', $facility)) ? 1: 0));
        $house->f_air = ((is_null($facility)) ? 0 : ((in_array('air', $facility)) ? 1: 0));

        $house->f_room_service = ((is_null($facility)) ? 0 : ((in_array('room_service', $facility)) ? 1: 0));
        $house->f_front_desk = ((is_null($facility)) ? 0 : ((in_array('front_desk', $facility)) ? 1: 0));
        $house->f_beach = ((is_null($facility)) ? 0 : ((in_array('beach', $facility)) ? 1: 0));
        $house->f_hot = ((is_null($facility)) ? 0 : ((in_array('hot', $facility)) ? 1: 0));
        $house->f_spa = ((is_null($facility)) ? 0 : ((in_array('spa', $facility)) ? 1: 0));
        $house->f_laundry = ((is_null($facility)) ? 0 : ((in_array('laundry', $facility)) ? 1: 0));
        $house->f_tv = ((is_null($facility)) ? 0 : ((in_array('tv', $facility)) ? 1: 0));
        $house->f_smoke = ((is_null($facility)) ? 0 : ((in_array('smoke', $facility)) ? 1: 0));

        if (!$house->save()) {
            $res = array(
                'status' => 400,
                'message' => 'Database error'
            );
            return json_encode($res);
        } 


        //============ Image Multiple Upload ==============
        $allowedfileExtension=['bmp','jpg','png'];
        $files = $req->file('images');

        if(!is_null($req->file('images')) ) {

            foreach ($files as $key => $image) {
                # code...
                // $filename = $file->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                $check=in_array(strtolower($extension),$allowedfileExtension);

                if($check) {
                    $destinationPath = 'upload/images';
                    $filename = $house->name . date('Ymdhmsa'). rand(10,10000). '.' .$extension;

                    $image->move($destinationPath,$filename);

                    $img = new Image;
                    $img->house_id = $house->id;
                    $img->path = $destinationPath . '/' . $filename;
                    if(!$img->save()) {
                        $res = array(
                            'status' => 400,
                            'message' => 'File upload error!'
                        );
                        return json_encode($res);
                        break;
                    }
                    
                }
            }
        }

        $res = array(
            'status' => 200,
            'message' => 'House saved successfully'
        );
        return json_encode($res);
    }

    /************************************
     * Add Room
     *
     *************************************/
    public function addRoom(Request $req) {
        if ($req->id == 0) {
            // $houses = House::where('visible',1)->get();
            $houses = House::get();
            $data = array('houses' => $houses, 'house' => null);
        } else {
            $house = House::find($req->id);

            $data = array('houses' => null, 'house' => $house);

        }   
        return view('admin/addRoom')->with($data);
    }

    public function addRoomPost(Request $req) {

        $id = isset($req->id) ? $req->id : 0; 

        if(!$id) {
            if(is_null($req->file('images')) ) {
                $res = array(
                    'status' => 300,
                    'message' => 'No file selected!'
                );
                return json_encode($res);
            }

            $exist = Room::where('house_id', $req->house_id)->where('name', $req->name)->first();
            if(!is_null($exist) ) {
                $res = array(
                    'status' => 300,
                    'message' => 'Room name is already exist!'
                );
                return json_encode($res);
            }
        }


        $rooms = ($id) ? Room::find($id) : new Room;
        $rooms->name = $req->name;
        $rooms->house_id = $req->house_id;


        $house = House::find($req->house_id);

        if($id && $rooms->cur_price > $req->cur_price) {
            $rooms->pre_price = $rooms->cur_price;
            $rate = (1 - $req->cur_price/$rooms->pre_price) * 100;
            $rooms->cut_rate = round($rate);
        }   

        if($id) {
            $rooms->visible_cut = ($req->visible_cut == null) ? 0 : 1;
        }

        $rooms->cur_price = $req->cur_price;
        $rooms->desc = $req->desc;
        $rooms->island = $house->island;
        $rooms->email = $req->email;
        $rooms->phone = $req->phone;
        $rooms->address = $req->address;

        // if($req->room_offer!=null && in_array('breakfast', $req->room_offer)) $room->breakfast = 1;
        $room_offer = $req->room_offer;
        $facility = $req->facility;

        // Room Offers

        $rooms->internet = (is_null($room_offer)) ? 0 : ((in_array('internet', $room_offer)) ? 1: 0);
        $rooms->pool = (is_null($room_offer)) ? 0 : ((in_array('pool', $room_offer)) ? 1: 0);
        $rooms->fitness = (is_null($room_offer)) ? 0 : ((in_array('fitness', $room_offer)) ? 1: 0);
        $rooms->park = (is_null($room_offer)) ? 0 : ((in_array('park', $room_offer)) ? 1: 0);
        $rooms->restaurant = (is_null($room_offer)) ? 0 : ((in_array('restaurant', $room_offer)) ? 1: 0);

        $rooms->breakfast = (is_null($room_offer)) ? 0 : ((in_array('breakfast', $room_offer)) ? 1: 0);
        $rooms->kid = (is_null($room_offer)) ? 0 : ((in_array('kid', $room_offer)) ? 1: 0);
        $rooms->pet = (is_null($room_offer)) ? 0 : ((in_array('pet', $room_offer)) ? 1: 0);
        $rooms->air = (is_null($room_offer)) ? 0 : ((in_array('air', $room_offer)) ? 1: 0);

        $rooms->room_service = (is_null($room_offer)) ? 0 : ((in_array('room_service', $room_offer)) ? 1: 0);
        $rooms->front_desk = (is_null($room_offer)) ? 0 : ((in_array('front_desk', $room_offer)) ? 1: 0);
        $rooms->beach = (is_null($room_offer)) ? 0 : ((in_array('beach', $room_offer)) ? 1: 0);
        $rooms->hot = (is_null($room_offer)) ? 0 : ((in_array('hot', $room_offer)) ? 1: 0);
        $rooms->spa = (is_null($room_offer)) ? 0 : ((in_array('spa', $room_offer)) ? 1: 0);
        $rooms->laundry = (is_null($room_offer)) ? 0 : ((in_array('laundry', $room_offer)) ? 1: 0);
        $rooms->tv = (is_null($room_offer)) ? 0 : ((in_array('tv', $room_offer)) ? 1: 0);
        $rooms->smoke = (is_null($room_offer)) ? 0 : ((in_array('smoke', $room_offer)) ? 1: 0);
        $rooms->bar = (is_null($room_offer)) ? 0 : ((in_array('bar', $room_offer)) ? 1: 0);
        

        // Facilities
        $rooms->f_internet = ((is_null($facility)) ? 0 : ((in_array('internet', $facility)) ? 1: 0));
        $rooms->f_pool = ((is_null($facility)) ? 0 : ((in_array('pool', $facility)) ? 1: 0));
        $rooms->f_bar = ((is_null($facility)) ? 0 : ((in_array('bar', $facility)) ? 1: 0));
        $rooms->f_fitness = ((is_null($facility)) ? 0 : ((in_array('fitness', $facility)) ? 1: 0));
        $rooms->f_park = ((is_null($facility)) ? 0 : ((in_array('park', $facility)) ? 1: 0));
        $rooms->f_restaurant = ((is_null($facility)) ? 0 : ((in_array('restaurant', $facility)) ? 1: 0));

        $rooms->f_breakfast = ((is_null($facility)) ? 0 : ((in_array('breakfast', $facility)) ? 1: 0));
        $rooms->f_kid = ((is_null($facility)) ? 0 : ((in_array('kid', $facility)) ? 1: 0));
        $rooms->f_pet = ((is_null($facility)) ? 0 : ((in_array('pet', $facility)) ? 1: 0));
        $rooms->f_air = ((is_null($facility)) ? 0 : ((in_array('air', $facility)) ? 1: 0));

        $rooms->f_room_service = ((is_null($facility)) ? 0 : ((in_array('room_service', $facility)) ? 1: 0));
        $rooms->f_front_desk = ((is_null($facility)) ? 0 : ((in_array('front_desk', $facility)) ? 1: 0));
        $rooms->f_beach = ((is_null($facility)) ? 0 : ((in_array('beach', $facility)) ? 1: 0));
        $rooms->f_hot = ((is_null($facility)) ? 0 : ((in_array('hot', $facility)) ? 1: 0));
        $rooms->f_spa = ((is_null($facility)) ? 0 : ((in_array('spa', $facility)) ? 1: 0));
        $rooms->f_laundry = ((is_null($facility)) ? 0 : ((in_array('laundry', $facility)) ? 1: 0));
        $rooms->f_tv = ((is_null($facility)) ? 0 : ((in_array('tv', $facility)) ? 1: 0));
        $rooms->f_smoke = ((is_null($facility)) ? 0 : ((in_array('smoke', $facility)) ? 1: 0));


        // $rooms->breakfast = (is_null($room_offer)) ? 0 : ((in_array('breakfast', $room_offer)) ? 1: 0);
        // $rooms->kid = (is_null($room_offer)) ? 0 : ((in_array('kid', $room_offer)) ? 1: 0);
        // $rooms->pet = (is_null($room_offer)) ? 0 : ((in_array('pet', $room_offer)) ? 1: 0);
        // $rooms->pet = (is_null($room_offer)) ? 0 : ((in_array('pet', $room_offer)) ? 1: 0);
        // $rooms->air = (is_null($room_offer)) ? 0 : ((in_array('air', $room_offer)) ? 1: 0);
        
        // $rooms->internet = (is_null($facility)) ? 0 : ((in_array('internet', $facility)) ? 1: 0);
        // $rooms->pool = (is_null($facility)) ? 0 : ((in_array('pool', $facility)) ? 1: 0);
        // $rooms->fitness = (is_null($facility)) ? 0 : ((in_array('fitness', $facility)) ? 1: 0);
        // $rooms->park = (is_null($facility)) ? 0 : ((in_array('park', $facility)) ? 1: 0);
        // $rooms->restaurant = (is_null($facility)) ? 0 : ((in_array('restaurant', $facility)) ? 1: 0);

        if (!$rooms->save()) {
            $res = array(
                'status' => 400,
                'message' => 'Database error'
            );
            return json_encode($res);
        } 


        //============ Image Multiple Upload ==============
        $allowedfileExtension=['bmp','jpg','png'];
        $files = $req->file('images');

        if(!is_null($req->file('images')) ) {

            foreach ($files as $key => $image) {
                # code...
                // $filename = $file->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                $check=in_array(strtolower($extension),$allowedfileExtension);

                if($check) {
                    $destinationPath = 'upload/images';
                    $filename = $rooms->name . date('Ymdhmsa'). rand(10,10000). '.' .$extension;

                    $image->move($destinationPath,$filename);

                    $img = new Image;
                    $img->room_id = $rooms->id;
                    $img->path = $destinationPath . '/' . $filename;
                    if(!$img->save()) {
                        $res = array(
                            'status' => 400,
                            'message' => 'File upload error!'
                        );
                        return json_encode($res);
                        break;
                    }
                    
                }
            }
        }

        $res = array(
            'status' => 200,
            'message' => 'Room saved successfully'
        );
        return json_encode($res);
    }


    /**************************************
     * House List
     *
     **************************************/
    public function houseList(Request $req) {

        $houses = (!is_null($req->visible)) ? House::where('visible', $req->visible)->paginate(10) : House::paginate(10);
        $res = array(
            'houses' => $houses,
            'visible' => $req->visible
        );


        return view('admin/houseList')->with($res);

    }

    // House Visible
    public function houseVisible(Request $req) {
        $house = House::find($req->id);
        $house->visible = !$house->visible;
        if(!$house->save()) {
            $res = array(
                'status' => 400,
                'message' => 'Database error!'
            );
        } else {
            $msg = $house->visible ? 'This house will be shown successfully!' : 'This house is not shown any more!';
            $code = $house->visible ? 200 : 300;
            $res = array(
                'status' => $code,
                'message' => $msg
            );
        }
        return json_encode($res); 
    }


    /***************************************
     * @ House Detail
     *
     *****************************************/
    public function houseDetail(Request $req, $id) {
        $house = House::find($id);
        return view('admin/houseDetail')->with(array('house' => $house));
    }

    /**************************************
     * List Room
     *
     **************************************/
    public function roomList(Request $req) {
        if($req->house_id != 0) {
             $house = House::find($req->house_id);
             $rooms = (!is_null($req->visible)) ? Room::where('house_id', $req->house_id)->where('visible', $req->visible)->paginate(10) : Room::where('house_id', $req->house_id)->paginate(10);

             $res = array(
                'house' => $house,
                'rooms' => $rooms,
                'visible' => $req->visible
            );
        } else {
            $rooms = (!is_null($req->visible)) ? Room::where('visible', $req->visible)->paginate(10) : Room::paginate(10);

             $res = array(
                'house' => null,
                'rooms' => $rooms,
                'visible' => $req->visible
            );
        }
        return view('admin/roomList')->with($res);
    }

    // Set Visible
    public function setVisible(Request $req) {
        $room = Room::find($req->id);
        $room->visible = !$room->visible;
        if(!$room->save()) {
            $res = array(
                'status' => 400,
                'message' => 'Database error!'
            );
        } else {
            $msg = $room->visible ? 'This room will be shown successfully!' : 'This room is not shown any more!';
            $code = $room->visible ? 200 : 300;
            $res = array(
                'status' => $code,
                'message' => $msg
            );
        }
        return json_encode($res); 
    }


    // Delete Room
    public function deletRoom(Request $req) {
        $room = Room::find($req->id);

        if($room->delete()) {
            $res = array(
                'status' => 200,
                'message' => 'The room deleted successfully!'
            );
        } else {
            $res = array(
                'status' => 400,
                'message' => 'Database error!'
            );
        }
        return json_encode($res); 
    }

    /***************************************
     * @ Room Detail
     *
     *****************************************/
    public function roomDetail(Request $req, $id) {
        $room = Room::find($id);
        return view('admin/roomDetail')->with(array('room' => $room));
    }

    // Delete Image
    public function delImage(Request $req) {
        $image = Image::find($req->id);

        if($image->delete()) {
            $res = array(
                'status' => 200,
                'message' => 'The image deleted successfully!'
            );
        } else {
            $res = array(
                'status' => 400,
                'message' => 'Database error!'
            );
        }
        return json_encode($res); 
    }
}
