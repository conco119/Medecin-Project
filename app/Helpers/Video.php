<?php
namespace App\Helpers;
use Carbon;
use App\Eloquent\User;
use Storage;
use Anchu\Ftp\Facades\Ftp;
class Video {
  public function defaultDate() {
    return  Carbon\Carbon::now()->toDateString();
  }
    public function formatDate($date) {
      $dateTime = Carbon\Carbon::now()->toDateTimeString();
      $time = strstr($dateTime, ' ');
      $dateTimeFormated = str_replace(['-', ' ', ':'], ['', '-', ''], $date.$time);
      return $dateTimeFormated;
    }

    public function date($date) {
      if($date == '')
          return $this->defaultDate();
      return $date;
    }

    public function nameVideo($dateFomated, $userId) {
      return $dateFomated. '-'. $userId;
    }

    public function saveHistory($request) {
      $user = User::findorFail($request->userId);
      $date_examination = $this->date($request->date_examination);
      $content = $request->content ? $request->content : "";
      return $history = $user->histories()->create([
        'content' => $content,
        'date_examination' => $date_examination
      ]);
    }

    public function saveMedia($history, $request) {

      if($request->hasFile('video'))  {
          $video = $request->video;
          $year = Carbon\Carbon::now()->year;
          $month = Carbon\Carbon::now()->month;

          $listing = FTP::connection()->getDirListing('video/');
          foreach($listing as $folder) {
            if($folder != $year) {
              FTP::connection()->makeDir('video/'.$year.'/');
            }
          }
          $listing = FTP::connection()->getDirListing('video/'. $year . '/');
          foreach($listing as $folder) {
            if($folder != $month) {
              FTP::connection()->makeDir('video/' .$year. '/' . $month . '/');
            }
          }

          $extension = $video->getClientOriginalExtension();
          $videoName = $this->formatDate($this->date($request->date_examination));
          $videoName = $this->nameVideo($videoName, $request->userId);
          $videoNameWithExtension = $videoName . "." . $extension;
          $path = 'video/' . $year . '/'. $month . '/';
          if(in_array($extension, ['mp4', 'mov', 'avi', '3gp'])) {
            Storage::putFileAs(
              $path, $video, $videoNameWithExtension
            );
            
            $history->media()->create([
              'name' => $videoName,
              'type' => $extension,
              'path' => $path
            ]);
            return true;
          }
          return false;
        }
        return false;
    }

    public static function update($video, $name) {
      if($video) {
        $extension = $video->getClientOriginalExtension();
        if(in_array($extension, ['mp4', 'mov', 'avi', '3gp'])) {
          $path = Storage::putFileAs(
            'video', $video, $name . '.' .$extension
          );
          return $extension;
      }
      return false;
    }
    return true;
  }
}

 ?>
