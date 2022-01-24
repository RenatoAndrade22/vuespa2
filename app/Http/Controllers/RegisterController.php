<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use mikehaertl\pdftk\Pdf;
use Smalot\PdfParser\Parser;


class RegisterController extends Controller
{
    public function teste(Request $request)
    {
        $file = $request->file;

        $request->validate([
            'file' => 'required|mimes:pdf',
        ]);

        $file = '';
        $pdf = new Pdf;
        $result = $pdf->addFile('./nota-de-corretagem.pdf', null, '129')
            ->saveAs('./new.pdf');
        if ($result === false) {
            $error = $pdf->getError();
            dd('erro', $error);
        }
        dd($result);
        // use of pdf parser to read content from pdf
//        $fileName = $file->getClientOriginalName();
//
//        $pdfParser = new Parser();
//        $pdf = $pdfParser->parseFile($file->path());
//        $content = $pdf->getText();
//        $clear = str_replace("\t", '', $content);
//        $result = explode("\n", $clear);
//        dd($result);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->saveOrFail();
    }
}












