<?php

namespace App\Traits;
use App\Models\UserFile;
use Illuminate\Support\File;
trait FileTrait{

    public function uploadCommonFiles($request){
        if($request->file('preapproval') !== null){               
            $preapproval = $request->file('preapproval')->store('preapproval', 'public'); 
            UserFile::create([
                // 'name' => $request->file('preapproval')->getClientOriginalName(),
                'name' => 'preapproval',
                'path' => $preapproval,
                'user_id' => auth()->user()->id
            ]);               
        }
        if($request->file('passport') !== null){               
            $passport = $request->file('passport')->store('passport', 'public');
            UserFile::create([
                'name' => 'passport',
                'path' => $passport,
                'user_id' => auth()->user()->id
            ]);                
        }
        if($request->file('bankstatement') !== null){               
            $bankstatement = $request->file('bankstatement')->store('bankstatement', 'public');
            UserFile::create([
                'name' => 'bank',
                'path' => $bankstatement,
                'user_id' => auth()->user()->id
            ]);                 
        }

        if($request->file('payslip_file') !== null){               
            $payslip_file = $request->file('payslip_file')->store('payslip_file', 'public');
            UserFile::create([
                'name' => 'payslip',
                'path' => $payslip_file,
                'user_id' => auth()->user()->id
            ]);          
        }

        if($request->file('nrc_file') !== null){               
            $nrc_file = $request->file('nrc_file')->store('nrc_file', 'public');
            UserFile::create([
                'name' => 'nrc',
                'path' => $nrc_file,
                'user_id' => auth()->user()->id
            ]);         
        }
    }
}