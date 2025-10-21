<?php

namespace App\Helpers;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\SimpleType\Jc;

class WordExportHelper
{
    public static function createWord($fileName, $contentCallback)
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection([
            'marginTop' => 1200,
            'marginBottom' => 800,
        ]);

        // 🖼️ Kop
        $header = $section->addHeader();
        $header->addImage(
            public_path('assets/img/kop.png'),
            ['width' => 600, 'alignment' => Jc::CENTER]
        );

        // ✍️ Isi surat
        $contentCallback($section);

        // 📜 Footer
        $footer = $section->addFooter();
        $footer->addImage(
            public_path('assets/img/footer.png'),
            ['width' => 600, 'alignment' => Jc::CENTER]
        );

        // 💾 Simpan file sementara
        $path = storage_path("app/public/{$fileName}.docx");
        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($path);

        // ⬇️ Download otomatis
        return response()->download($path)->deleteFileAfterSend(true);
    }
}
