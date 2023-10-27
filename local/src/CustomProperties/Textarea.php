<?php
namespace App\CustomProperties;

class Textarea {
    public static function getTypeDescription() {
        return [
            'PROPERTY_TYPE' => 'S',
            'USER_TYPE' => 'CUSTOM_TEXTAREA',
            'DESCRIPTION' => 'Custom textarea',
            'GetPropertyFieldHtml' => [__CLASS__, 'GetPropertyFieldHtml'],
            'GetSettingsHTML' => [__CLASS__, 'GetSettingsHTML'],
            'ConvertFromDB' => [__CLASS__, 'ConvertFromDB'],
            'ConvertToDB' => [__CLASS__, 'ConvertToDB'],
        ];
    }

    public static function GetPropertyFieldHtml($arProperty, $values, $strHTMLControlName) {
        $html = '';
        $inputName = $strHTMLControlName['VALUE'];
        $values = $values['VALUE'];

        $title = $values['TITLE'] ?? '';
        $description = $values['DESCRIPTION'] ?? '';

        ob_start();
        ?>

        <div class="input-container">
            <div class="input-wrapper">
                <label>Заголовок:</label>
                <input name="<?=$inputName?>[TITLE]" value="<?=$title?>">
            </div>

            <div class="input-wrapper">
                <label>Комментарий:</label>
                <textarea rows="5" name="<?=$inputName?>[DESCRIPTION]"><?=$description?></textarea>
            </div>
        </div>

        <style>
            .input-container {
                float:left;
            }

            .input-wrapper {
                text-align:right;
                line-height:25px;
            }

            .input-wrapper label {
                float: left;
                padding-right:10px;
            }
        </style>

        <?php
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }

    public static function ConvertToDB($arProperty, $value) {
        if(empty($value['VALUE']['TITLE']) || empty($value['VALUE']['DESCRIPTION'])) {
            return false;
        }

        $value['VALUE'] = serialize($value['VALUE']);

        return $value;
    }

    public static function ConvertFromDB($arProperty, $value, $format = '')
    {
        $value['VALUE'] = unserialize($value['VALUE']);

        return $value;
    }

    static function GetSettingsHTML($arProperty, $strHTMLControlName, &$arPropertyFields){
        $arPropertyFields = [
            'HIDE' => [
                'SMART_FILTER',
                'SEARCHABLE',
                'FILTER_HINT',
            ],
            'SET' => [
                'SMART_FILTER' => 'N',
                'SEARCHABLE' => 'N',
            ],
        ];

        return $html;
    }
}