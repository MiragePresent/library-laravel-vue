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
        'aa' => 'Qafaraf',
        'ab' => 'Аҧсуа',
        'ae' => 'avesta',
        'af' => 'Afrikaans',
        'ak' => 'Akan',
        'am' => 'አማርኛ',
        'an' => 'Aragonés',
        'ar' => 'العربية',
        'as' => 'অসমীয়া',
        'av' => 'авар мацӀ; магӀарул мацӀ',
        'ay' => 'aymar aru',
        'az' => 'azərbaycan dili',
        'ba' => 'башҡорт теле',
        'be' => 'Беларуская',
        'bg' => 'български език',
        'bh' => 'भोजपुरी',
        'bi' => 'Bislama',
        'bm' => 'bamanankan',
        'bn' => 'বাংলা',
        'bo' => 'བོད་ཡིག',
        'br' => 'brezhoneg',
        'bs' => 'bosanski jezik',
        'ca' => 'Català',
        'ce' => 'нохчийн мотт',
        'ch' => 'Chamoru',
        'co' => 'corsu; lingua corsa',
        'cr' => 'ᓀᐦᐃᔭᐍᐏᐣ',
        'cs' => 'česky; čeština',
        'cu' => '',
        'cv' => 'чӑваш чӗлхи',
        'cy' => 'Cymraeg',
        'da' => 'dansk',
        'de' => 'Deutsch',
        'dv' => '',
        'dz' => 'རྫོང་ཁ',
        'ee' => 'Ɛʋɛgbɛ',
        'el' => 'Ελληνικά',
        'en' => 'English',
        'eo' => 'Esperanto',
        'es' => 'español; castellano',
        'et' => 'Eesti keel',
        'eu' => 'euskara',
        'fa' => 'فارسی',
        'ff' => 'Fulfulde',
        'fi' => 'suomen kieli',
        'fj' => 'vosa Vakaviti',
        'fo' => 'Føroyskt',
        'fr' => 'français; langue française',
        'fy' => 'Frysk',
        'ga' => 'Gaeilge',
        'gd' => 'Gàidhlig',
        'gl' => 'Galego',
        'gn' => 'Avañe\'ẽ',
        'gu' => 'ગુજરાતી',
        'gv' => 'Ghaelg',
        'ha' => '‫هَوُسَ',
        'he' => '‫עברית',
        'hi' => 'हिन्दी; हिंदी',
        'ho' => 'Hiri Motu',
        'hr' => 'Hrvatski',
        'ht' => 'Kreyòl ayisyen',
        'hu' => 'Magyar',
        'hy' => 'Հայերեն',
        'hz' => 'Otjiherero',
        'ia' => 'interlingua',
        'id' => 'Bahasa Indonesia',
        'ie' => 'Interlingue',
        'ig' => 'Igbo',
        'ii' => 'ꆇꉙ',
        'ik' => 'Iñupiaq; Iñupiatun',
        'io' => 'Ido',
        'is' => 'Íslenska',
        'it' => 'Italiano',
        'iu' => 'ᐃᓄᒃᑎᑐᑦ',
        'ja' => '日本語 (にほんご／にっぽんご)',
        'jv' => 'basa Jawa',
        'ka' => 'ქართული',
        'kg' => 'KiKongo',
        'ki' => 'Gĩkũyũ',
        'kj' => 'Kuanyama',
        'kk' => 'Қазақ тілі',
        'kl' => 'kalaallisut; kalaallit oqaasii',
        'km' => 'ភាសាខ្មែរ',
        'kn' => 'ಕನ್ನಡ',
        'ko' => '한국어 (韓國語); 조선말 (朝鮮語)',
        'kr' => 'Kanuri',
        'ks' => 'कश्मीरी    كشميري',
        'ku' => 'Kurdî; كوردی',
        'kv' => 'коми кыв',
        'kw' => 'Kernewek',
        'ky' => 'кыргыз тили',
        'la' => 'latine; lingua latina',
        'lb' => 'Lëtzebuergesch',
        'lg' => 'Luganda',
        'li' => 'Limburgs',
        'ln' => 'Lingála',
        'lo' => 'ພາສາລາວ',
        'lt' => 'lietuvių kalba',
        'lu' => '',
        'lv' => 'latviešu valoda',
        'mg' => 'Malagasy fiteny',
        'mh' => 'Kajin M̧ajeļ',
        'mi' => 'te reo Māori',
        'mk' => 'македонски јазик',
        'ml' => 'മലയാളം',
        'mn' => 'Монгол',
        'mr' => 'मराठी',
        'ms' => 'bahasa Melayu; بهاس ملايو',
        'mt' => 'Malti',
        'my' => 'ဗမာစာ',
        'na' => 'Ekakairũ Naoero',
        'nb' => 'Norsk bokmål',
        'nd' => 'isiNdebele',
        'ne' => 'नेपाली',
        'ng' => 'Owambo',
        'nl' => 'Nederlands',
        'nn' => 'Norsk nynorsk',
        'no' => 'Norsk',
        'nr' => 'Ndébélé',
        'nv' => 'Diné bizaad; Dinékʼehǰí',
        'ny' => 'chiCheŵa; chinyanja',
        'oc' => 'Occitan',
        'oj' => 'ᐊᓂᔑᓈᐯᒧᐎᓐ',
        'om' => 'Afaan Oromoo',
        'or' => 'ଓଡ଼ିଆ',
        'os' => 'Ирон æвзаг',
        'pa' => 'ਪੰਜਾਬੀ; پنجابی',
        'pi' => 'पाऴि',
        'pl' => 'polski',
        'ps' => '‫پښتو',
        'pt' => 'Português',
        'qu' => 'Runa Simi; Kichwa',
        'rm' => 'rumantsch grischun',
        'rn' => 'kiRundi',
        'ro' => 'română;limba moldoveneasca',
        'ru' => 'русский язык',
        'rw' => 'Kinyarwanda',
        'ry' => 'русинськый язык',
        'sa' => 'संस्कृतम्',
        'sc' => 'sardu',
        'sd' => 'सिन्धी; ‫سنڌي، سندھی',
        'se' => 'Davvisámegiella',
        'sg' => 'yângâ tî sängö',
        'sh' => 'Srpskohrvatski/Српскохрватски',
        'si' => 'සිංහල',
        'sk' => 'slovenčina',
        'sl' => 'slovenščina',
        'sm' => 'gagana fa\'a Samoa',
        'sn' => 'chiShona',
        'so' => 'Soomaaliga; af Soomaali',
        'sq' => 'Shqip',
        'sr' => 'српски језик',
        'ss' => 'SiSwati',
        'st' => 'seSotho',
        'su' => 'Basa Sunda',
        'sv' => 'Svenska',
        'sw' => 'Kiswahili',
        'ta' => 'தமிழ்',
        'te' => 'తెలుగు',
        'tg' => 'тоҷикӣ; toğikī; ‫تاجیکی',
        'th' => 'ไทย',
        'ti' => 'ትግርኛ',
        'tk' => 'Türkmen; Түркмен',
        'tl' => 'Tagalog',
        'tn' => 'seTswana',
        'to' => 'faka Tonga',
        'tr' => 'Türkçe',
        'ts' => 'xiTsonga',
        'tt' => 'татарча; tatarça; ‫تاتارچا',
        'tw' => 'Twi',
        'ty' => 'Reo Mā`ohi',
        'ug' => 'Uyƣurqə; ‫ئۇيغۇرچ',
        'uk' => 'Українська',
        'ur' => '‫اردو',
        'uz' => 'O\'zbek; Ўзбек; أۇزبېك',
        've' => 'tshiVenḓa',
        'vi' => 'Tiếng Việt',
        'vo' => 'Volapük',
        'wa' => 'Walon',
        'wo' => 'Wollof',
        'xh' => 'isiXhosa',
        'yi' => '‫ייִדיש',
        'yo' => 'Yorùbá',
        'za' => 'Saɯ cueŋƅ; Saw cuengh',
        'zh' => '中文, 汉语, 漢語',
        'zu' => 'isiZulu'
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
        return collect($this->languages)->map(function ($title, $code) {
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