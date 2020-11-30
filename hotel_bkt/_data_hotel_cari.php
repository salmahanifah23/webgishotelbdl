<?php
require '../connect.php';

$tipe = $_GET["tipe"];		// Cari berdasarkan apa
$nilai = $_GET["nilai"];	// Isi yang dicari

/*
ISI TIPE:
	1 => Nama
	2 => Adress
	3 => Tipe
	4 => tipe hotel
*/

if ($tipe == 1) {
	$querysearch	="SELECT id, name, st_x(st_centroid(geom)) as lon, st_y(st_centroid(geom)) as lat from hotel where  LOWER(name) like '%".$nilai."%';";
} elseif ($tipe == 2) {
	$querysearch	="SELECT id, name, st_x(st_centroid(hotel.geom)) as lon, st_y(st_centroid(hotel.geom)) as lat from hotel where  LOWER(address) like '%".$nilai."%';";
} elseif ($tipe == 3) {
	$querysearch	="SELECT hotel.id, hotel.name, st_x(st_centroid(hotel.geom)) as lon, st_y(st_centroid(hotel.geom)) as lat from hotel left join hotel_type on hotel_type.id = hotel.id_type where  LOWER(hotel_type.id) like '%".$nilai."%';";
} elseif ($tipe == 4) {
	$querysearch	="SELECT detail_room.id_room, detail_room.id_type, room.name, hotel.id, hotel.name, st_x(st_centroid(hotel.geom)) as lon, st_y(st_centroid(hotel.geom)) as lat from hotel join detail_room on detail_room.id_hotel = hotel.id join room on detail_room.id_type=room.id_type where  LOWER(detail_room.id_type) like '%".$nilai."%';";
}

$hasil=mysqli_query($conn, $querysearch);
while($baris = mysqli_fetch_array($hasil))
	{
		  $id=$baris['id'];
		  $name=$baris['name'];
		  $lat=$baris['lat'];
		  $lng=$baris['lon'];
		  $dataarray[]=array('id'=>$id,'name'=>$name, 'lng'=>$lng, 'lat'=>$lat);
	}
echo json_encode ($dataarray);
?>