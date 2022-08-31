<?php

namespace App\Http\Controllers\admin;
use App\Http\Requests\UpdateProfileFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('site.profile.profile');
    }

    public function ProfileUpdate(Request $request)
    {

        $user = auth()->user();

        $data = $request->all();

        if ($data['password'] != null)
            $data['password'] = bcrypt($data['password']);
        else
            unset($data['password']);

        
        $data['image'] = $user->image;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($user->image)
                $name = $user->image;
            else
                $name = $user->id.$user->name;
            
            $extenstion = $request->image->extension();
            $nameFile = "{$name}.{$extenstion}";

            $data['image'] = $nameFile;

            $upload = $request->image->storeAs('users', $nameFile);

            if (!$upload)
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer o upload da imagem');
        }

        $update = $user->update($data);

        if ($update)
            return redirect()
                        ->route('Profile')
                        ->with('success', 'Sucesso ao atualizar!');

        return redirect()
                    ->back()
                    ->with('error', 'Falha ao atualizar o perfil...');
    }
}