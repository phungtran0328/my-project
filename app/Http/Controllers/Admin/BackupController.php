<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 11/11/2018
 * Time: 2:45 PM
 */

namespace app\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function index(){
        $disk = Storage::disk(config('backup.destination.disks.local'));
        $files = $disk->files(config('backup.name'));

//        dd($disk, $files);
        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('backup.name') . '/', '', $f),
                    'file_size' => $disk->size($f),
                    'last_modified' => $disk->lastModified($f),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);

        $temp = new Helper();
        $backups = $temp->paginate($backups,2,request('page'), ['path' => request()->path()]);

        return view('admin.manage.backup')->with(compact('backups'));
    }

    public function create(){
        try {
            Artisan::call('backup:run',['--only-db'=>true]);
            $output = Artisan::output();
            $user = Auth::user();
            // log the results => ./storage/logs/laravel.log
            Log::info("Backpack\\BackupManager -- new backup started from admin interface, admin: ".$user->NV_TEN."\r\n" . $output);
            return redirect()->back()->with('messCreate','Đã tạo mới sao lưu dữ liệu !');

        }catch (\Exception $exception){
            return redirect()->back()->with('messError',$exception->getMessage());
        }
    }

    public function download($file_name)
    {
        $file = config('backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);
            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }

    public function delete($file_name)
    {
        $disk = Storage::disk(config('backup.destination.disks')[0]);
        if ($disk->exists(config('backup.name') . '/' . $file_name)) {
            $disk->delete(config('backup.name') . '/' . $file_name);
            return redirect()->back()->with('delete','Đã xóa !');
        } else {
            return redirect()->back()->with('deleteError','Xóa không thành công !');
        }
    }
}