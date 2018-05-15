<?php

namespace App\Repositories;

use App\Entities\LanguageContract;
use Illuminate\Support\Collection;
use App\Entities\Language;

class LanguageRepository implements LanguageRepositoryContract
{
    /**
     *  Source https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
     * @var array
     */
    protected $languages = [
        'ab' => "Abkhazian",
        'aa' => "Afar",
        'af' => "Afrikaans",
        'ak' => "Akan",
        'sq' => "Albanian",
        'am' => "Amharic",
        'ar' => "Arabic",
        'an' => "Aragonese",
        'hy' => "Armenian",
        'as' => "Assamese",
        'av' => "Avaric",
        'ae' => "Avestan",
        'ay' => "Aymara",
        'az' => "Azerbaijani",
        'bm' => "Bambara",
        'ba' => "Bashkir",
        'eu' => "Basque",
        'be' => "Belarusian",
        'bn' => "Bengali",
        'bh' => "Bihari languages",
        'bi' => "Bislama",
        'bs' => "Bosnian",
        'br' => "Breton",
        'bg' => "Bulgarian",
        'my' => "Burmese",
        'ca' => "Catalan, Valencian",
        'ch' => "Chamorro",
        'ce' => "Chechen",
        'ny' => "Chichewa, Chewa, Nyanja",
        'zh' => "Chinese",
        'cv' => "Chuvash",
        'kw' => "Cornish",
        'co' => "Corsican",
        'cr' => "Cree",
        'hr' => "Croatian",
        'cs' => "Czech",
        'da' => "Danish",
        'dv' => "Divehi, Dhivehi, Maldivian",
        'nl' => "Dutch, Flemish",
        'dz' => "Dzongkha",
        'en' => "English",
        'eo' => "Esperanto",
        'et' => "Estonian",
        'ee' => "Ewe",
        'fo' => "Faroese",
        'fj' => "Fijian",
        'fl' => "Filipino",
        'fi' => "Finnish",
        'fr' => "French",
        'ff' => "Fulah",
        'gl' => "Galician",
        'ka' => "Georgian",
        'de' => "German",
        'el' => "Greek (modern)",
        'gn' => "Guaraní",
        'gu' => "Gujarati",
        'ht' => "Haitian, Haitian Creole",
        'ha' => "Hausa",
        'he' => "Hebrew (modern)",
        'hz' => "Herero",
        'hi' => "Hindi",
        'ho' => "Hiri Motu",
        'hu' => "Hungarian",
        'ia' => "Interlingua",
        'id' => "Indonesian",
        'ie' => "Interlingue",
        'ga' => "Irish",
        'ig' => "Igbo",
        'ik' => "Inupiaq",
        'io' => "Ido",
        'is' => "Icelandic",
        'it' => "Italian",
        'iu' => "Inuktitut",
        'ja' => "Japanese",
        'jv' => "Javanese",
        'kl' => "Kalaallisut, Greenlandic",
        'kn' => "Kannada",
        'kr' => "Kanuri",
        'ks' => "Kashmiri",
        'kk' => "Kazakh",
        'km' => "Central Khmer",
        'ki' => "Kikuyu, Gikuyu",
        'rw' => "Kinyarwanda",
        'ky' => "Kirghiz, Kyrgyz",
        'kv' => "Komi",
        'kg' => "Kongo",
        'ko' => "Korean",
        'ku' => "Kurdish",
        'kj' => "Kuanyama, Kwanyama",
        'la' => "Latin",
        'lb' => "Luxembourgish, Letzeburgesch",
        'lg' => "Ganda",
        'li' => "Limburgan, Limburger, Limburgish",
        'ln' => "Lingala",
        'lo' => "Lao",
        'lt' => "Lithuanian",
        'lu' => "Luba-Katanga",
        'lv' => "Latvian",
        'gv' => "Manx",
        'mk' => "Macedonian",
        'mg' => "Malagasy",
        'ms' => "Malay",
        'ml' => "Malayalam",
        'mt' => "Maltese",
        'mi' => "Maori",
        'mr' => "Marathi",
        'mh' => "Marshallese",
        'mn' => "Mongolian",
        'na' => "Nauru",
        'nv' => "Navajo, Navaho",
        'nd' => "North Ndebele",
        'ne' => "Nepali",
        'ng' => "Ndonga",
        'nb' => "Norwegian Bokmål",
        'nn' => "Norwegian Nynorsk",
        'no' => "Norwegian",
        'ii' => "Sichuan Yi, Nuosu",
        'nr' => "South Ndebele",
        'oc' => "Occitan",
        'oj' => "Ojibwa",
        'cu' => "Church Slavic, Church Slavonic, Old Church Slavonic, Old Slavonic, Old Bulgarian",
        'om' => "Oromo",
        'or' => "Oriya",
        'os' => "Ossetian, Ossetic",
        'pa' => "Panjabi, Punjabi",
        'pi' => "Pali",
        'fa' => "Persian",
        'pl' => "Polish",
        'ps' => "Pashto, Pushto",
        'pt' => "Portuguese",
        'qu' => "Quechua",
        'rm' => "Romansh",
        'rn' => "Rundi",
        'ro' => "Romanian, Moldavian, Moldovan",
        'ru' => "Russian",
        'sa' => "Sanskrit",
        'sc' => "Sardinian",
        'sd' => "Sindhi",
        'se' => "Northern Sami",
        'sm' => "Samoan",
        'sg' => "Sango",
        'sr' => "Serbian",
        'gd' => "Gaelic, Scottish Gaelic",
        'sn' => "Shona",
        'si' => "Sinhala, Sinhalese",
        'sk' => "Slovak",
        'sl' => "Slovenian",
        'so' => "Somali",
        'st' => "Southern Sotho",
        'es' => "Spanish, Castilian",
        'su' => "Sundanese",
        'sw' => "Swahili",
        'ss' => "Swati",
        'sv' => "Swedish",
        'ta' => "Tamil",
        'te' => "Telugu",
        'tg' => "Tajik",
        'th' => "Thai",
        'ti' => "Tigrinya",
        'bo' => "Tibetan",
        'tk' => "Turkmen",
        'tl' => "Tagalog",
        'tn' => "Tswana",
        'to' => "Tonga (Tonga Islands)",
        'tr' => "Turkish",
        'ts' => "Tsonga",
        'tt' => "Tatar",
        'tw' => "Twi",
        'ty' => "Tahitian",
        'ug' => "Uighur, Uyghur",
        'uk' => "Ukrainian",
        'ur' => "Urdu",
        'uz' => "Uzbek",
        've' => "Venda",
        'vi' => "Vietnamese",
        'vo' => "Volapük",
        'wa' => "Walloon",
        'cy' => "Welsh",
        'wo' => "Wolof",
        'fy' => "Western Frisian",
        'xh' => "Xhosa",
        'yi' => "Yiddish",
        'yo' => "Yoruba",
        'za' => "Zhuang, Chuang",
        'zu' => "Zulu",
    ];

    /**
     *  Find language by code
     * @param string $code
     * @return LanguageContract
     */
    public function find(string $code): LanguageContract
    {
        if (!$this->isValid($code)) {
            throw new \InvalidArgumentException("Code '$code' is invalid");
        }
        return Language::make($code, $this->languages[$code]);
    }

    /**
     *  Get random language
     * @return LanguageContract
     */
    public function random(): LanguageContract
    {
        return $this->find(array_rand($this->languages));
    }

    /**
     *  Get all languages
     * @return Collection
     */
    public function all(): Collection
    {
        return collect($this->languages)
            ->map(function ($title, $code) {
                return Language::make($code, $title);
            });
    }

    /**
     *  Check if ISO code is valid
     * @param string $code
     * @return bool
     */
    public function isValid(string $code): bool
    {
        return array_key_exists($code, $this->languages);
    }
}