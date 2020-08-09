<?php

    function imageUpload_handler($request){
        if ($request->hasFile('companyLogo')){
            //Get file from client side
            $file = $request->file('companyLogo');
            //Get original file from input request
            $filename = ucfirst($request->input('companyName'));
            //Get file extension
            $fileExt = $file->getClientOriginalExtension();
            $fileNameToStore = strtoupper($filename . '-' . md5(time())) . '.' . $fileExt;
            $location = 'public/admin_panel/img/';
            //Save file
            $file->storeAs($location, $fileNameToStore);
        } else {
            //Default Image
            $companyName = ucfirst($request->input('companyName'));
            $getCompanyFirstLetter = substr($companyName, 0, 1);
            $ext = 'png';
            $fileNameToStore = strtoupper($companyName . '-' . md5(time())) . '.' . $ext;
            $img = GenerateAlphaAvatar($getCompanyFirstLetter);

            $img->save(storage_path() . '/app/public/admin_panel/img/' . $fileNameToStore, '90');
        }
        return $fileNameToStore;
    }

    function imageUpdate_handler($assets, $request){
        $fileNameToStore ='';
        if ($request->hasFile('companyLogo')){
            if (\File::exists(storage_path() . '/app/public/admin_panel/img/' . $assets->company_logo)){
                \File::delete(storage_path() . '/app/public/admin_panel/img/' . $assets->company_logo);
            }
            //Get original file from input request
            $file = $request->file('companyLogo');
            $filename = ucfirst($request->input('companyName'));
            //Get file extension
            $fileExt = $file->getClientOriginalExtension();
            $fileNameToStore = strtoupper($filename . '-' . md5(time())) . '.' . $fileExt;
            $location = 'public/admin_panel/img/';
            //Save file
            $file->storeAs($location, $fileNameToStore);
        } else {
            //Default Image
            $newCompanyName = ucfirst($request->input('companyName'));
            $oldCompanyName = $assets->company_name;

            if ($newCompanyName !== $oldCompanyName){
                $logo = $assets->company_logo;
                $logoName = explode("-", $logo);
                //$fileNameToStore = $assets->company_logo;
                if ($oldCompanyName !== $logoName[0]){
                    //dd('not e');
                    if (\File::exists(storage_path() . '/app/public/admin_panel/img/' . $assets->company_logo)) {
                        \File::delete(storage_path() . '/app/public/admin_panel/img/' . $assets->company_logo);
                    }
                    $getCompanyFirstLetter = substr($newCompanyName, 0, 1);
                    $ext = 'png';
                    $fileNameToStore = strtoupper($newCompanyName . '-' . md5(time())) . '.' . $ext;
                    $img = GenerateAlphaAvatar($getCompanyFirstLetter);

                    $img->save(storage_path() . '/app/public/admin_panel/img/' . $fileNameToStore, '90');

                } else {
                    if ($newCompanyName !== $logoName[0]){
                        $fileNameToStore = $assets->company_logo;
                    }
                    //dd('not equal');
                }
            } else {
                $fileNameToStore = $assets->company_logo;
            }
        }
        return $fileNameToStore;
    }
