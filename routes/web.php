<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//
Route::get('/', 'HomeController@getHome');

//test
Route::get('/test', 'TestController@index');
Route::get('/services', 'ServiceController@index');
Route::post('/services', 'ServiceController@store');

//görevler
Route::get('/tasks', 'TaskController@index');
Route::get('/tasks/create', 'TaskController@create');
Route::post('/tasks', 'TaskController@store');
Route::get('/tasks/{task}', 'TaskController@show');
Route::get('/tasks/{task}/edit', 'TaskController@edit');
Route::patch('/tasks/{task}', 'TaskController@update');
Route::patch('/tasks/iptal/{task}', 'TaskController@iptal');
Route::delete('/tasks/{task}', 'TaskController@destroy');
Route::patch('/tasks/{task}', 'TaskController@tamamla');
Route::patch('/tasks/bitir/{task}', 'TaskController@hizliTamamla');
//ayarlar
Route::get('/ayarlar', 'AyarlarController@index');
Route::get('/ayarlar/kullanicilar', 'AyarlarController@kullanicilariYonet');
Route::get('/ayarlar/kullanicilar/{user}', 'AyarlarController@kullanicilarEdit');
Route::get('/ayarlar/kategoriekle', 'AyarlarController@kategoriEkle');
Route::post('/ayarlar', 'AyarlarController@kategoriEklestore');
Route::get('/ayarlar/kategoriduzenle/{kategori}', 'AyarlarController@kategoriDuzenle');
Route::patch('/ayarlar/kategoriduzenle/{kategori}', 'AyarlarController@kategoriDuzenleupdate');
Route::delete('/ayarlar/kategoriduzenle/{kategori}', 'AyarlarController@kategoriSil');
Route::get('/ayarlar/durumduzenle', 'AyarlarController@durumDuzenle');
Route::post('/ayarlar/durumKaydet', 'AyarlarController@durumKaydet');

//Blog
Route::get('/blog', 'BlogPostController@index');
Route::get('/blog/{post}', 'BlogPostController@show');
Route::get('/blog/postEkle', 'BlogPostController@postEkle');
Route::post('/blog/postEkle', 'BlogPostController@postKaydet');
Route::delete('/blog/{post}', 'BlogPostController@postSil');
//Projeler
// Route::get('/projeler', 'ProjeController@index');
// Route::get('/projeler/{proje}', 'ProjeController@getProje');
// Route::get('/projeler/projeEkle', 'ProjeController@projeEkle');
// Route::post('/projeler/projeEkle', 'ProjeController@projeKaydet');
// Route::delete('/projeler/{proje}', 'ProjeController@projeSil');
//Portfoy
Route::get('/portfolyo', 'Portfolyo@index');
Route::get('/portfolyo/dgs', 'Portfolyo@dgs');
Route::get('/portfolyo/musteri/{musteri}', 'Portfolyo@getMusteri');
Route::get('/portfolyo/musteriEkle', 'Portfolyo@musteriEkle');
Route::post('/portfolyo/musteriKaydet', 'Portfolyo@musteriKaydet');
Route::get('/portfolyo/tamamla', 'Portfolyo@isTamamla');
Route::patch('/portfolyo/musteriGuncelle/{id}', 'Portfolyo@musteriGuncelle');
Route::delete('/portfolyo/{musteri}', 'Portfolyo@musteriSil');
//Arama
Route::get('/arama', 'AramaController@aramaSonuclari');
Route::get('/kisiaramainput', 'AramaController@kisiArama');
Route::get('/filtrele', 'AramaController@filtrele');
//Muhasebe
Route::post('/muhasebe/islemYap', 'MuhasebeController@islemYap');
Route::post('/muhasebe/getHareket', 'MuhasebeController@getHareket');
Route::post('/muhasebe/deleteHareket', 'MuhasebeController@deleteHareket');
Route::post('/muhasebe/bakiyeKapat', 'MuhasebeController@bakiyeKapat');
Route::post('/muhasebe/bakiyeAc', 'MuhasebeController@bakiyeAc');
//Dosya Sistemi
Route::post('/dosyaKaydet', 'Portfolyo@dosyaKaydet');
Route::get('/dosyaIndir/{musteri}/{dosyaKodu}', 'Portfolyo@dosyaIndir');
Route::get('/dosyaSil/{musteri}/{dosyaKodu}', 'Portfolyo@dosyaSil');

//Özel
Route::get('/bakiyeleriisle', 'MuhasebeController@bakiyeleriIsle');
//Telefon Aramaları
Route::get('/misc/telefonAramasiIsle/','TelefonAramalariController@telefonKaydiIsle');
//APİ
Route::get('/api', 'Portfolyo@api');

//Profil
Route::get('/profil', 'ProfilController@index');

//Ajanda
Route::get('/ajanda', 'AjandaController@index');

//Yönetim
Route::get('/yonetim', 'YonetimController@index');
Route::get('/yonetim/dagilimRaporlari', 'YonetimController@dagilimRaporlari');
Route::get('/yonetim/charts', 'YonetimController@charts');
//Misc
Route::get('/portfolyo/gsi', 'YonetimController@gsi');
Route::get('/sehirler', 'YonetimController@sehirler');

Auth::routes();
Route::get('/home', 'HomeController@getHome')->name('home');