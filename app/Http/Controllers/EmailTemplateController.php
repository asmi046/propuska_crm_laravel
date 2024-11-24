<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Artisan;
use App\Http\Requests\EmailTemplateRequest;

class EmailTemplateController extends Controller
{
    public function email_template_list_get() {
        return EmailTemplate::all();

    }

    public function email_template_update(EmailTemplateRequest $request) {
        $data = $request->validated();

        $item = EmailTemplate::where('id', $data['id'])->first();

        if(!$item) abort('403', "Не найдена запись");

        $item->update([
            "subj" => $data['subj'],
            "text" => $data['text'],
        ]);

        Artisan::call('optimize:clear');

        return [
            "id" => $data['id'],
            "subj" => $data['subj'],
            "text" => $data['text'],
        ];
    }

    public function index() {
        return view('email-templates.list');
    }
}
