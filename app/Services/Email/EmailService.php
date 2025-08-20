<?php

namespace App\Services\Email;

use Illuminate\Support\Facades\File;

class EmailService
{
    function update($data, $request)
    {
        $oldTemplates = config('templates');

        foreach ($data as $key => $value) {
            if ($key === 'template') {
                continue;
            }
            $oldTemplates[$request->template][$key] = $value;
        }

        $filePath = base_path('Config/templates.php');

        $phpCode = '<?php return ' . var_export($oldTemplates, true) . ';';

        File::put($filePath, $phpCode);
    }
}
