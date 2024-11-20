<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $countries = array(
            array('name' => 'Afghanistan','code' => 'AF','created_at' => '2022-10-13 11:38:05','updated_at' => '2022-10-13 11:38:05','deleted_at' => NULL),
            array('name' => 'Åland Islands','code' => 'AX','created_at' => '2022-10-13 11:38:08','updated_at' => '2022-10-13 11:38:08','deleted_at' => NULL),
            array('name' => 'Albania','code' => 'AL','created_at' => '2022-10-13 11:38:09','updated_at' => '2022-10-13 11:38:09','deleted_at' => NULL),
            array('name' => 'Algeria','code' => 'DZ','created_at' => '2022-10-13 11:38:10','updated_at' => '2022-10-13 11:38:10','deleted_at' => NULL),
            array('name' => 'American Samoa','code' => 'AS','created_at' => '2022-10-13 11:38:13','updated_at' => '2022-10-13 11:38:13','deleted_at' => NULL),
            array('name' => 'Andorra','code' => 'AD','created_at' => '2022-10-13 11:38:14','updated_at' => '2022-10-13 11:38:14','deleted_at' => NULL),
            array('name' => 'Angola','code' => 'AO','created_at' => '2022-10-13 11:38:14','updated_at' => '2022-10-13 11:38:14','deleted_at' => NULL),
            array('name' => 'Anguilla','code' => 'AI','created_at' => '2022-10-13 11:38:16','updated_at' => '2022-10-13 11:38:16','deleted_at' => NULL),
            array('name' => 'Antarctica','code' => 'AQ','created_at' => '2022-10-13 11:38:17','updated_at' => '2022-10-13 11:38:17','deleted_at' => NULL),
            array('name' => 'Antigua and Barbuda','code' => 'AG','created_at' => '2022-10-13 11:38:18','updated_at' => '2022-10-13 11:38:18','deleted_at' => NULL),
            array('name' => 'Argentina','code' => 'AR','created_at' => '2022-10-13 11:38:20','updated_at' => '2022-10-13 11:38:20','deleted_at' => NULL),
            array('name' => 'Armenia','code' => 'AM','created_at' => '2022-10-13 11:38:22','updated_at' => '2022-10-13 11:38:22','deleted_at' => NULL),
            array('name' => 'Aruba','code' => 'AW','created_at' => '2022-10-13 11:38:23','updated_at' => '2022-10-13 11:38:23','deleted_at' => NULL),
            array('name' => 'Australia','code' => 'AU','created_at' => '2022-10-13 11:38:23','updated_at' => '2022-10-13 11:38:23','deleted_at' => NULL),
            array('name' => 'Austria','code' => 'AT','created_at' => '2022-10-13 11:38:24','updated_at' => '2022-10-13 11:38:24','deleted_at' => NULL),
            array('name' => 'Azerbaijan','code' => 'AZ','created_at' => '2022-10-13 11:38:24','updated_at' => '2022-10-13 11:38:24','deleted_at' => NULL),
            array('name' => 'Bahamas','code' => 'BS','created_at' => '2022-10-13 11:38:29','updated_at' => '2022-10-13 11:38:29','deleted_at' => NULL),
            array('name' => 'Bahrain','code' => 'BH','created_at' => '2022-10-13 11:38:31','updated_at' => '2022-10-13 11:38:31','deleted_at' => NULL),
            array('name' => 'Bangladesh','code' => 'BD','created_at' => '2022-10-13 11:38:32','updated_at' => '2022-10-13 11:38:32','deleted_at' => NULL),
            array('name' => 'Barbados','code' => 'BB','created_at' => '2022-10-13 11:38:32','updated_at' => '2022-10-13 11:38:32','deleted_at' => NULL),
            array('name' => 'Belarus','code' => 'BY','created_at' => '2022-10-13 11:38:33','updated_at' => '2022-10-13 11:38:33','deleted_at' => NULL),
            array('name' => 'Belgium','code' => 'BE','created_at' => '2022-10-13 11:38:33','updated_at' => '2022-10-13 11:38:33','deleted_at' => NULL),
            array('name' => 'Belize','code' => 'BZ','created_at' => '2022-10-13 11:38:34','updated_at' => '2022-10-13 11:38:34','deleted_at' => NULL),
            array('name' => 'Benin','code' => 'BJ','created_at' => '2022-10-13 11:38:34','updated_at' => '2022-10-13 11:38:34','deleted_at' => NULL),
            array('name' => 'Bermuda','code' => 'BM','created_at' => '2022-10-13 11:38:35','updated_at' => '2022-10-13 11:38:35','deleted_at' => NULL),
            array('name' => 'Bhutan','code' => 'BT','created_at' => '2022-10-13 11:38:36','updated_at' => '2022-10-13 11:38:36','deleted_at' => NULL),
            array('name' => 'Bolivia','code' => 'BO','created_at' => '2022-10-13 11:38:37','updated_at' => '2022-10-13 11:38:37','deleted_at' => NULL),
            array('name' => 'Bonaire, Sint Eustatius and Saba','code' => 'BQ','created_at' => '2022-10-13 11:38:38','updated_at' => '2022-10-13 11:38:38','deleted_at' => NULL),
            array('name' => 'Bosnia and Herzegovina','code' => 'BA','created_at' => '2022-10-13 11:38:38','updated_at' => '2022-10-13 11:38:38','deleted_at' => NULL),
            array('name' => 'Botswana','code' => 'BW','created_at' => '2022-10-13 11:38:38','updated_at' => '2022-10-13 11:38:38','deleted_at' => NULL),
            array('name' => 'Bouvet Island','code' => 'BV','created_at' => '2022-10-13 11:38:39','updated_at' => '2022-10-13 11:38:39','deleted_at' => NULL),
            array('name' => 'Brazil','code' => 'BR','created_at' => '2022-10-13 11:38:39','updated_at' => '2022-10-13 11:38:39','deleted_at' => NULL),
            array('name' => 'British Indian Ocean Territory','code' => 'IO','created_at' => '2022-10-13 11:38:41','updated_at' => '2022-10-13 11:38:41','deleted_at' => NULL),
            array('name' => 'Brunei Darussalam','code' => 'BN','created_at' => '2022-10-13 11:38:42','updated_at' => '2022-10-13 11:38:42','deleted_at' => NULL),
            array('name' => 'Bulgaria','code' => 'BG','created_at' => '2022-10-13 11:38:42','updated_at' => '2022-10-13 11:38:42','deleted_at' => NULL),
            array('name' => 'Burkina Faso','code' => 'BF','created_at' => '2022-10-13 11:38:45','updated_at' => '2022-10-13 11:38:45','deleted_at' => NULL),
            array('name' => 'Burundi','code' => 'BI','created_at' => '2022-10-13 11:38:48','updated_at' => '2022-10-13 11:38:48','deleted_at' => NULL),
            array('name' => 'Cambodia','code' => 'KH','created_at' => '2022-10-13 11:38:50','updated_at' => '2022-10-13 11:38:50','deleted_at' => NULL),
            array('name' => 'Cameroon','code' => 'CM','created_at' => '2022-10-13 11:38:52','updated_at' => '2022-10-13 11:38:52','deleted_at' => NULL),
            array('name' => 'Canada','code' => 'CA','created_at' => '2022-10-13 11:38:53','updated_at' => '2022-10-13 11:38:53','deleted_at' => NULL),
            array('name' => 'Cape Verde','code' => 'CV','created_at' => '2022-10-13 11:38:55','updated_at' => '2022-10-13 11:38:55','deleted_at' => NULL),
            array('name' => 'Cayman Islands','code' => 'KY','created_at' => '2022-10-13 11:38:56','updated_at' => '2022-10-13 11:38:56','deleted_at' => NULL),
            array('name' => 'Central African Republic','code' => 'CF','created_at' => '2022-10-13 11:38:57','updated_at' => '2022-10-13 11:38:57','deleted_at' => NULL),
            array('name' => 'Chad','code' => 'TD','created_at' => '2022-10-13 11:38:58','updated_at' => '2022-10-13 11:38:58','deleted_at' => NULL),
            array('name' => 'Chile','code' => 'CL','created_at' => '2022-10-13 11:39:00','updated_at' => '2022-10-13 11:39:00','deleted_at' => NULL),
            array('name' => 'China','code' => 'CN','created_at' => '2022-10-13 11:39:01','updated_at' => '2022-10-13 11:39:01','deleted_at' => NULL),
            array('name' => 'Christmas Island','code' => 'CX','created_at' => '2022-10-13 11:39:04','updated_at' => '2022-10-13 11:39:04','deleted_at' => NULL),
            array('name' => 'Cocos (Keeling) Islands','code' => 'CC','created_at' => '2022-10-13 11:39:04','updated_at' => '2022-10-13 11:39:04','deleted_at' => NULL),
            array('name' => 'Colombia','code' => 'CO','created_at' => '2022-10-13 11:39:05','updated_at' => '2022-10-13 11:39:05','deleted_at' => NULL),
            array('name' => 'Comoros','code' => 'KM','created_at' => '2022-10-13 11:39:09','updated_at' => '2022-10-13 11:39:09','deleted_at' => NULL),
            array('name' => 'Congo, Republic of the (Brazzaville)','code' => 'CG','created_at' => '2022-10-13 11:39:09','updated_at' => '2022-10-13 11:39:09','deleted_at' => NULL),
            array('name' => 'Congo, the Democratic Republic of the (Kinshasa)','code' => 'CD','created_at' => '2022-10-13 11:39:11','updated_at' => '2022-10-13 11:39:11','deleted_at' => NULL),
            array('name' => 'Cook Islands','code' => 'CK','created_at' => '2022-10-13 11:39:12','updated_at' => '2022-10-13 11:39:12','deleted_at' => NULL),
            array('name' => 'Costa Rica','code' => 'CR','created_at' => '2022-10-13 11:39:13','updated_at' => '2022-10-13 11:39:13','deleted_at' => NULL),
            array('name' => 'Côte d\'Ivoire, Republic of','code' => 'CI','created_at' => '2022-10-13 11:39:13','updated_at' => '2022-10-13 11:39:13','deleted_at' => NULL),
            array('name' => 'Croatia','code' => 'HR','created_at' => '2022-10-13 11:39:15','updated_at' => '2022-10-13 11:39:15','deleted_at' => NULL),
            array('name' => 'Cuba','code' => 'CU','created_at' => '2022-10-13 11:39:16','updated_at' => '2022-10-13 11:39:16','deleted_at' => NULL),
            array('name' => 'Curaçao','code' => 'CW','created_at' => '2022-10-13 11:39:17','updated_at' => '2022-10-13 11:39:17','deleted_at' => NULL),
            array('name' => 'Cyprus','code' => 'CY','created_at' => '2022-10-13 11:39:17','updated_at' => '2022-10-13 11:39:17','deleted_at' => NULL),
            array('name' => 'Czech Republic','code' => 'CZ','created_at' => '2022-10-13 11:39:18','updated_at' => '2022-10-13 11:39:18','deleted_at' => NULL),
            array('name' => 'Denmark','code' => 'DK','created_at' => '2022-10-13 11:39:19','updated_at' => '2022-10-13 11:39:19','deleted_at' => NULL),
            array('name' => 'Djibouti','code' => 'DJ','created_at' => '2022-10-13 11:39:19','updated_at' => '2022-10-13 11:39:19','deleted_at' => NULL),
            array('name' => 'Dominica','code' => 'DM','created_at' => '2022-10-13 11:39:19','updated_at' => '2022-10-13 11:39:19','deleted_at' => NULL),
            array('name' => 'Dominican Republic','code' => 'DO','created_at' => '2022-10-13 11:39:20','updated_at' => '2022-10-13 11:39:20','deleted_at' => NULL),
            array('name' => 'Ecuador','code' => 'EC','created_at' => '2022-10-13 11:39:21','updated_at' => '2022-10-13 11:39:21','deleted_at' => NULL),
            array('name' => 'Egypt','code' => 'EG','created_at' => '2022-10-13 11:39:22','updated_at' => '2022-10-13 11:39:22','deleted_at' => NULL),
            array('name' => 'El Salvador','code' => 'SV','created_at' => '2022-10-13 11:39:24','updated_at' => '2022-10-13 11:39:24','deleted_at' => NULL),
            array('name' => 'Equatorial Guinea','code' => 'GQ','created_at' => '2022-10-13 11:39:26','updated_at' => '2022-10-13 11:39:26','deleted_at' => NULL),
            array('name' => 'Eritrea','code' => 'ER','created_at' => '2022-10-13 11:39:26','updated_at' => '2022-10-13 11:39:26','deleted_at' => NULL),
            array('name' => 'Estonia','code' => 'EE','created_at' => '2022-10-13 11:39:26','updated_at' => '2022-10-13 11:39:26','deleted_at' => NULL),
            array('name' => 'Ethiopia','code' => 'ET','created_at' => '2022-10-13 11:39:27','updated_at' => '2022-10-13 11:39:27','deleted_at' => NULL),
            array('name' => 'Falkland Islands (Islas Malvinas)','code' => 'FK','created_at' => '2022-10-13 11:39:28','updated_at' => '2022-10-13 11:39:28','deleted_at' => NULL),
            array('name' => 'Faroe Islands','code' => 'FO','created_at' => '2022-10-13 11:39:28','updated_at' => '2022-10-13 11:39:28','deleted_at' => NULL),
            array('name' => 'Fiji','code' => 'FJ','created_at' => '2022-10-13 11:39:29','updated_at' => '2022-10-13 11:39:29','deleted_at' => NULL),
            array('name' => 'Finland','code' => 'FI','created_at' => '2022-10-13 11:39:30','updated_at' => '2022-10-13 11:39:30','deleted_at' => NULL),
            array('name' => 'France','code' => 'FR','created_at' => '2022-10-13 11:39:31','updated_at' => '2022-10-13 11:39:31','deleted_at' => NULL),
            array('name' => 'French Guiana','code' => 'GF','created_at' => '2022-10-13 11:39:33','updated_at' => '2022-10-13 11:39:33','deleted_at' => NULL),
            array('name' => 'French Polynesia','code' => 'PF','created_at' => '2022-10-13 11:39:33','updated_at' => '2022-10-13 11:39:33','deleted_at' => NULL),
            array('name' => 'French Southern and Antarctic Lands','code' => 'TF','created_at' => '2022-10-13 11:39:33','updated_at' => '2022-10-13 11:39:33','deleted_at' => NULL),
            array('name' => 'Gabon','code' => 'GA','created_at' => '2022-10-13 11:39:34','updated_at' => '2022-10-13 11:39:34','deleted_at' => NULL),
            array('name' => 'Gambia, The','code' => 'GM','created_at' => '2022-10-13 11:39:34','updated_at' => '2022-10-13 11:39:34','deleted_at' => NULL),
            array('name' => 'Georgia','code' => 'GE','created_at' => '2022-10-13 11:39:35','updated_at' => '2022-10-13 11:39:35','deleted_at' => NULL),
            array('name' => 'Germany','code' => 'DE','created_at' => '2022-10-13 11:39:36','updated_at' => '2022-10-13 11:39:36','deleted_at' => NULL),
            array('name' => 'Ghana','code' => 'GH','created_at' => '2022-10-13 11:39:38','updated_at' => '2022-10-13 11:39:38','deleted_at' => NULL),
            array('name' => 'Gibraltar','code' => 'GI','created_at' => '2022-10-13 11:39:39','updated_at' => '2022-10-13 11:39:39','deleted_at' => NULL),
            array('name' => 'Greece','code' => 'GR','created_at' => '2022-10-13 11:39:39','updated_at' => '2022-10-13 11:39:39','deleted_at' => NULL),
            array('name' => 'Greenland','code' => 'GL','created_at' => '2022-10-13 11:39:40','updated_at' => '2022-10-13 11:39:40','deleted_at' => NULL),
            array('name' => 'Grenada','code' => 'GD','created_at' => '2022-10-13 11:39:40','updated_at' => '2022-10-13 11:39:40','deleted_at' => NULL),
            array('name' => 'Guadeloupe','code' => 'GP','created_at' => '2022-10-13 11:39:41','updated_at' => '2022-10-13 11:39:41','deleted_at' => NULL),
            array('name' => 'Guam','code' => 'GU','created_at' => '2022-10-13 11:39:41','updated_at' => '2022-10-13 11:39:41','deleted_at' => NULL),
            array('name' => 'Guatemala','code' => 'GT','created_at' => '2022-10-13 11:39:41','updated_at' => '2022-10-13 11:39:41','deleted_at' => NULL),
            array('name' => 'Guernsey','code' => 'GG','created_at' => '2022-10-13 11:39:42','updated_at' => '2022-10-13 11:39:42','deleted_at' => NULL),
            array('name' => 'Guinea','code' => 'GN','created_at' => '2022-10-13 11:39:43','updated_at' => '2022-10-13 11:39:43','deleted_at' => NULL),
            array('name' => 'Guinea-Bissau','code' => 'GW','created_at' => '2022-10-13 11:39:44','updated_at' => '2022-10-13 11:39:44','deleted_at' => NULL),
            array('name' => 'Guyana','code' => 'GY','created_at' => '2022-10-13 11:39:45','updated_at' => '2022-10-13 11:39:45','deleted_at' => NULL),
            array('name' => 'Haiti','code' => 'HT','created_at' => '2022-10-13 11:39:45','updated_at' => '2022-10-13 11:39:45','deleted_at' => NULL),
            array('name' => 'Heard Island and McDonald Islands','code' => 'HM','created_at' => '2022-10-13 11:39:46','updated_at' => '2022-10-13 11:39:46','deleted_at' => NULL),
            array('name' => 'Holy See (Vatican City)','code' => 'VA','created_at' => '2022-10-13 11:39:46','updated_at' => '2022-10-13 11:39:46','deleted_at' => NULL),
            array('name' => 'Honduras','code' => 'HN','created_at' => '2022-10-13 11:41:27','updated_at' => '2022-10-13 11:41:27','deleted_at' => NULL),
            array('name' => 'Hong Kong','code' => 'HK','created_at' => '2022-10-13 11:41:28','updated_at' => '2022-10-13 11:41:28','deleted_at' => NULL),
            array('name' => 'Hungary','code' => 'HU','created_at' => '2022-10-13 11:41:28','updated_at' => '2022-10-13 11:41:28','deleted_at' => NULL),
            array('name' => 'Iceland','code' => 'IS','created_at' => '2022-10-13 11:41:30','updated_at' => '2022-10-13 11:41:30','deleted_at' => NULL),
            array('name' => 'India','code' => 'IN','created_at' => '2022-10-13 11:41:31','updated_at' => '2022-10-13 11:41:31','deleted_at' => NULL),
            array('name' => 'Indonesia','code' => 'ID','created_at' => '2022-10-13 11:41:33','updated_at' => '2022-10-13 11:41:33','deleted_at' => NULL),
            array('name' => 'Iran, Islamic Republic of','code' => 'IR','created_at' => '2022-10-13 11:41:36','updated_at' => '2022-10-13 11:41:36','deleted_at' => NULL),
            array('name' => 'Iraq','code' => 'IQ','created_at' => '2022-10-13 11:41:38','updated_at' => '2022-10-13 11:41:38','deleted_at' => NULL),
            array('name' => 'Ireland','code' => 'IE','created_at' => '2022-10-13 11:41:39','updated_at' => '2022-10-13 11:41:39','deleted_at' => NULL),
            array('name' => 'Isle of Man','code' => 'IM','created_at' => '2022-10-13 11:41:41','updated_at' => '2022-10-13 11:41:41','deleted_at' => NULL),
            array('name' => 'Israel','code' => 'IL','created_at' => '2022-10-13 11:41:41','updated_at' => '2022-10-13 11:41:41','deleted_at' => NULL),
            array('name' => 'Italy','code' => 'IT','created_at' => '2022-10-13 11:41:41','updated_at' => '2022-10-13 11:41:41','deleted_at' => NULL),
            array('name' => 'Jamaica','code' => 'JM','created_at' => '2022-10-13 11:41:43','updated_at' => '2022-10-13 11:41:43','deleted_at' => NULL),
            array('name' => 'Japan','code' => 'JP','created_at' => '2022-10-13 11:41:44','updated_at' => '2022-10-13 11:41:44','deleted_at' => NULL),
            array('name' => 'Jersey','code' => 'JE','created_at' => '2022-10-13 11:41:47','updated_at' => '2022-10-13 11:41:47','deleted_at' => NULL),
            array('name' => 'Jordan','code' => 'JO','created_at' => '2022-10-13 11:41:47','updated_at' => '2022-10-13 11:41:47','deleted_at' => NULL),
            array('name' => 'Kazakhstan','code' => 'KZ','created_at' => '2022-10-13 11:41:48','updated_at' => '2022-10-13 11:41:48','deleted_at' => NULL),
            array('name' => 'Kenya','code' => 'KE','created_at' => '2022-10-13 11:41:50','updated_at' => '2022-10-13 11:41:50','deleted_at' => NULL),
            array('name' => 'Kiribati','code' => 'KI','created_at' => '2022-10-13 11:41:53','updated_at' => '2022-10-13 11:41:53','deleted_at' => NULL),
            array('name' => 'Korea, Democratic People\'s Republic of','code' => 'KP','created_at' => '2022-10-13 11:41:56','updated_at' => '2022-10-13 11:41:56','deleted_at' => NULL),
            array('name' => 'Korea, Republic of','code' => 'KR','created_at' => '2022-10-13 11:41:56','updated_at' => '2022-10-13 11:41:56','deleted_at' => NULL),
            array('name' => 'Kosovo','code' => 'XK','created_at' => '2022-10-13 11:41:58','updated_at' => '2022-10-13 11:41:58','deleted_at' => NULL),
            array('name' => 'Kuwait','code' => 'KW','created_at' => '2022-10-13 11:41:59','updated_at' => '2022-10-13 11:41:59','deleted_at' => NULL),
            array('name' => 'Kyrgyzstan','code' => 'KG','created_at' => '2022-10-13 11:42:00','updated_at' => '2022-10-13 11:42:00','deleted_at' => NULL),
            array('name' => 'Laos','code' => 'LA','created_at' => '2022-10-13 11:42:00','updated_at' => '2022-10-13 11:42:00','deleted_at' => NULL),
            array('name' => 'Latvia','code' => 'LV','created_at' => '2022-10-13 11:42:03','updated_at' => '2022-10-13 11:42:03','deleted_at' => NULL),
            array('name' => 'Lebanon','code' => 'LB','created_at' => '2022-10-13 11:42:11','updated_at' => '2022-10-13 11:42:11','deleted_at' => NULL),
            array('name' => 'Lesotho','code' => 'LS','created_at' => '2022-10-13 11:42:12','updated_at' => '2022-10-13 11:42:12','deleted_at' => NULL),
            array('name' => 'Liberia','code' => 'LR','created_at' => '2022-10-13 11:42:12','updated_at' => '2022-10-13 11:42:12','deleted_at' => NULL),
            array('name' => 'Libya','code' => 'LY','created_at' => '2022-10-13 11:42:14','updated_at' => '2022-10-13 11:42:14','deleted_at' => NULL),
            array('name' => 'Liechtenstein','code' => 'LI','created_at' => '2022-10-13 11:42:15','updated_at' => '2022-10-13 11:42:15','deleted_at' => NULL),
            array('name' => 'Lithuania','code' => 'LT','created_at' => '2022-10-13 11:42:16','updated_at' => '2022-10-13 11:42:16','deleted_at' => NULL),
            array('name' => 'Luxembourg','code' => 'LU','created_at' => '2022-10-13 11:42:17','updated_at' => '2022-10-13 11:42:17','deleted_at' => NULL),
            array('name' => 'Macao','code' => 'MO','created_at' => '2022-10-13 11:42:18','updated_at' => '2022-10-13 11:42:18','deleted_at' => NULL),
            array('name' => 'Macedonia, Republic of','code' => 'MK','created_at' => '2022-10-13 11:42:18','updated_at' => '2022-10-13 11:42:18','deleted_at' => NULL),
            array('name' => 'Madagascar','code' => 'MG','created_at' => '2022-10-13 11:42:23','updated_at' => '2022-10-13 11:42:23','deleted_at' => NULL),
            array('name' => 'Malawi','code' => 'MW','created_at' => '2022-10-13 11:42:23','updated_at' => '2022-10-13 11:42:23','deleted_at' => NULL),
            array('name' => 'Malaysia','code' => 'MY','created_at' => '2022-10-13 11:42:26','updated_at' => '2022-10-13 11:42:26','deleted_at' => NULL),
            array('name' => 'Maldives','code' => 'MV','created_at' => '2022-10-13 11:42:27','updated_at' => '2022-10-13 11:42:27','deleted_at' => NULL),
            array('name' => 'Mali','code' => 'ML','created_at' => '2022-10-13 11:42:29','updated_at' => '2022-10-13 11:42:29','deleted_at' => NULL),
            array('name' => 'Malta','code' => 'MT','created_at' => '2022-10-13 11:42:30','updated_at' => '2022-10-13 11:42:30','deleted_at' => NULL),
            array('name' => 'Marshall Islands','code' => 'MH','created_at' => '2022-10-13 11:42:36','updated_at' => '2022-10-13 11:42:36','deleted_at' => NULL),
            array('name' => 'Martinique','code' => 'MQ','created_at' => '2022-10-13 11:42:37','updated_at' => '2022-10-13 11:42:37','deleted_at' => NULL),
            array('name' => 'Mauritania','code' => 'MR','created_at' => '2022-10-13 11:42:37','updated_at' => '2022-10-13 11:42:37','deleted_at' => NULL),
            array('name' => 'Mauritius','code' => 'MU','created_at' => '2022-10-13 11:42:40','updated_at' => '2022-10-13 11:42:40','deleted_at' => NULL),
            array('name' => 'Mayotte','code' => 'YT','created_at' => '2022-10-13 11:42:41','updated_at' => '2022-10-13 11:42:41','deleted_at' => NULL),
            array('name' => 'Mexico','code' => 'MX','created_at' => '2022-10-13 11:42:43','updated_at' => '2022-10-13 11:42:43','deleted_at' => NULL),
            array('name' => 'Micronesia, Federated States of','code' => 'FM','created_at' => '2022-10-13 11:42:45','updated_at' => '2022-10-13 11:42:45','deleted_at' => NULL),
            array('name' => 'Moldova','code' => 'MD','created_at' => '2022-10-13 11:42:45','updated_at' => '2022-10-13 11:42:45','deleted_at' => NULL),
            array('name' => 'Monaco','code' => 'MC','created_at' => '2022-10-13 11:42:47','updated_at' => '2022-10-13 11:42:47','deleted_at' => NULL),
            array('name' => 'Mongolia','code' => 'MN','created_at' => '2022-10-13 11:42:48','updated_at' => '2022-10-13 11:42:48','deleted_at' => NULL),
            array('name' => 'Montenegro','code' => 'ME','created_at' => '2022-10-13 11:42:50','updated_at' => '2022-10-13 11:42:50','deleted_at' => NULL),
            array('name' => 'Montserrat','code' => 'MS','created_at' => '2022-10-13 11:42:52','updated_at' => '2022-10-13 11:42:52','deleted_at' => NULL),
            array('name' => 'Morocco','code' => 'MA','created_at' => '2022-10-13 11:42:52','updated_at' => '2022-10-13 11:42:52','deleted_at' => NULL),
            array('name' => 'Mozambique','code' => 'MZ','created_at' => '2022-10-13 11:42:53','updated_at' => '2022-10-13 11:42:53','deleted_at' => NULL),
            array('name' => 'Myanmar','code' => 'MM','created_at' => '2022-10-13 11:42:54','updated_at' => '2022-10-13 11:42:54','deleted_at' => NULL),
            array('name' => 'Namibia','code' => 'NA','created_at' => '2022-10-13 11:42:55','updated_at' => '2022-10-13 11:42:55','deleted_at' => NULL),
            array('name' => 'Nauru','code' => 'NR','created_at' => '2022-10-13 11:42:56','updated_at' => '2022-10-13 11:42:56','deleted_at' => NULL),
            array('name' => 'Nepal','code' => 'NP','created_at' => '2022-10-13 11:42:58','updated_at' => '2022-10-13 11:42:58','deleted_at' => NULL),
            array('name' => 'Netherlands','code' => 'NL','created_at' => '2022-10-13 11:42:58','updated_at' => '2022-10-13 11:42:58','deleted_at' => NULL),
            array('name' => 'New Caledonia','code' => 'NC','created_at' => '2022-10-13 11:42:59','updated_at' => '2022-10-13 11:42:59','deleted_at' => NULL),
            array('name' => 'New Zealand','code' => 'NZ','created_at' => '2022-10-13 11:42:59','updated_at' => '2022-10-13 11:42:59','deleted_at' => NULL),
            array('name' => 'Nicaragua','code' => 'NI','created_at' => '2022-10-13 11:43:01','updated_at' => '2022-10-13 11:43:01','deleted_at' => NULL),
            array('name' => 'Niger','code' => 'NE','created_at' => '2022-10-13 11:43:02','updated_at' => '2022-10-13 11:43:02','deleted_at' => NULL),
            array('name' => 'Nigeria','code' => 'NG','created_at' => '2022-10-13 11:43:03','updated_at' => '2022-10-13 11:43:03','deleted_at' => NULL),
            array('name' => 'Niue','code' => 'NU','created_at' => '2022-10-13 11:43:05','updated_at' => '2022-10-13 11:43:05','deleted_at' => NULL),
            array('name' => 'Norfolk Island','code' => 'NF','created_at' => '2022-10-13 11:43:05','updated_at' => '2022-10-13 11:43:05','deleted_at' => NULL),
            array('name' => 'Northern Mariana Islands','code' => 'MP','created_at' => '2022-10-13 11:43:06','updated_at' => '2022-10-13 11:43:06','deleted_at' => NULL),
            array('name' => 'Norway','code' => 'NO','created_at' => '2022-10-13 11:43:06','updated_at' => '2022-10-13 11:43:06','deleted_at' => NULL),
            array('name' => 'Oman','code' => 'OM','created_at' => '2022-10-13 11:43:07','updated_at' => '2022-10-13 11:43:07','deleted_at' => NULL),
            array('name' => 'Pakistan','code' => 'PK','created_at' => '2022-10-13 11:43:08','updated_at' => '2022-10-13 11:43:08','deleted_at' => NULL),
            array('name' => 'Palau','code' => 'PW','created_at' => '2022-10-13 11:43:09','updated_at' => '2022-10-13 11:43:09','deleted_at' => NULL),
            array('name' => 'Palestine, State of','code' => 'PS','created_at' => '2022-10-13 11:43:10','updated_at' => '2022-10-13 11:43:10','deleted_at' => NULL),
            array('name' => 'Panama','code' => 'PA','created_at' => '2022-10-13 11:43:11','updated_at' => '2022-10-13 11:43:11','deleted_at' => NULL),
            array('name' => 'Papua New Guinea','code' => 'PG','created_at' => '2022-10-13 11:43:13','updated_at' => '2022-10-13 11:43:13','deleted_at' => NULL),
            array('name' => 'Paraguay','code' => 'PY','created_at' => '2022-10-13 11:43:16','updated_at' => '2022-10-13 11:43:16','deleted_at' => NULL),
            array('name' => 'Peru','code' => 'PE','created_at' => '2022-10-13 11:43:19','updated_at' => '2022-10-13 11:43:19','deleted_at' => NULL),
            array('name' => 'Philippines','code' => 'PH','created_at' => '2022-10-13 11:43:58','updated_at' => '2022-10-13 11:43:58','deleted_at' => NULL),
            array('name' => 'Pitcairn','code' => 'PN','created_at' => '2022-10-13 11:44:03','updated_at' => '2022-10-13 11:44:03','deleted_at' => NULL),
            array('name' => 'Poland','code' => 'PL','created_at' => '2022-10-13 11:44:03','updated_at' => '2022-10-13 11:44:03','deleted_at' => NULL),
            array('name' => 'Portugal','code' => 'PT','created_at' => '2022-10-13 11:44:04','updated_at' => '2022-10-13 11:44:04','deleted_at' => NULL),
            array('name' => 'Puerto Rico','code' => 'PR','created_at' => '2022-10-13 11:44:05','updated_at' => '2022-10-13 11:44:05','deleted_at' => NULL),
            array('name' => 'Qatar','code' => 'QA','created_at' => '2022-10-13 11:44:10','updated_at' => '2022-10-13 11:44:10','deleted_at' => NULL),
            array('name' => 'Réunion','code' => 'RE','created_at' => '2022-10-13 11:44:10','updated_at' => '2022-10-13 11:44:10','deleted_at' => NULL),
            array('name' => 'Romania','code' => 'RO','created_at' => '2022-10-13 11:44:11','updated_at' => '2022-10-13 11:44:11','deleted_at' => NULL),
            array('name' => 'Russian Federation','code' => 'RU','created_at' => '2022-10-13 11:44:13','updated_at' => '2022-10-13 11:44:13','deleted_at' => NULL),
            array('name' => 'Rwanda','code' => 'RW','created_at' => '2022-10-13 11:44:21','updated_at' => '2022-10-13 11:44:21','deleted_at' => NULL),
            array('name' => 'Saint Barthélemy','code' => 'BL','created_at' => '2022-10-13 11:44:21','updated_at' => '2022-10-13 11:44:21','deleted_at' => NULL),
            array('name' => 'Saint Helena, Ascension and Tristan da Cunha','code' => 'SH','created_at' => '2022-10-13 11:44:21','updated_at' => '2022-10-13 11:44:21','deleted_at' => NULL),
            array('name' => 'Saint Kitts and Nevis','code' => 'KN','created_at' => '2022-10-13 11:44:22','updated_at' => '2022-10-13 11:44:22','deleted_at' => NULL),
            array('name' => 'Saint Lucia','code' => 'LC','created_at' => '2022-10-13 11:44:22','updated_at' => '2022-10-13 11:44:22','deleted_at' => NULL),
            array('name' => 'Saint Martin','code' => 'MF','created_at' => '2022-10-13 11:44:23','updated_at' => '2022-10-13 11:44:23','deleted_at' => NULL),
            array('name' => 'Saint Pierre and Miquelon','code' => 'PM','created_at' => '2022-10-13 11:44:23','updated_at' => '2022-10-13 11:44:23','deleted_at' => NULL),
            array('name' => 'Saint Vincent and the Grenadines','code' => 'VC','created_at' => '2022-10-13 11:44:23','updated_at' => '2022-10-13 11:44:23','deleted_at' => NULL),
            array('name' => 'Samoa','code' => 'WS','created_at' => '2022-10-13 11:44:24','updated_at' => '2022-10-13 11:44:24','deleted_at' => NULL),
            array('name' => 'San Marino','code' => 'SM','created_at' => '2022-10-13 11:44:24','updated_at' => '2022-10-13 11:44:24','deleted_at' => NULL),
            array('name' => 'Sao Tome and Principe','code' => 'ST','created_at' => '2022-10-13 11:44:25','updated_at' => '2022-10-13 11:44:25','deleted_at' => NULL),
            array('name' => 'Saudi Arabia','code' => 'SA','created_at' => '2022-10-13 11:44:25','updated_at' => '2022-10-13 11:44:25','deleted_at' => NULL),
            array('name' => 'Senegal','code' => 'SN','created_at' => '2022-10-13 11:44:26','updated_at' => '2022-10-13 11:44:26','deleted_at' => NULL),
            array('name' => 'Serbia','code' => 'RS','created_at' => '2022-10-13 11:44:27','updated_at' => '2022-10-13 11:44:27','deleted_at' => NULL),
            array('name' => 'Seychelles','code' => 'SC','created_at' => '2022-10-13 11:44:30','updated_at' => '2022-10-13 11:44:30','deleted_at' => NULL),
            array('name' => 'Sierra Leone','code' => 'SL','created_at' => '2022-10-13 11:44:32','updated_at' => '2022-10-13 11:44:32','deleted_at' => NULL),
            array('name' => 'Singapore','code' => 'SG','created_at' => '2022-10-13 11:44:32','updated_at' => '2022-10-13 11:44:32','deleted_at' => NULL),
            array('name' => 'Sint Maarten (Dutch part)','code' => 'SX','created_at' => '2022-10-13 11:44:33','updated_at' => '2022-10-13 11:44:33','deleted_at' => NULL),
            array('name' => 'Slovakia','code' => 'SK','created_at' => '2022-10-13 11:44:33','updated_at' => '2022-10-13 11:44:33','deleted_at' => NULL),
            array('name' => 'Slovenia','code' => 'SI','created_at' => '2022-10-13 11:44:33','updated_at' => '2022-10-13 11:44:33','deleted_at' => NULL),
            array('name' => 'Solomon Islands','code' => 'SB','created_at' => '2022-10-13 11:44:52','updated_at' => '2022-10-13 11:44:52','deleted_at' => NULL),
            array('name' => 'Somalia','code' => 'SO','created_at' => '2022-10-13 11:44:53','updated_at' => '2022-10-13 11:44:53','deleted_at' => NULL),
            array('name' => 'South Africa','code' => 'ZA','created_at' => '2022-10-13 11:44:54','updated_at' => '2022-10-13 11:44:54','deleted_at' => NULL),
            array('name' => 'South Georgia and South Sandwich Islands','code' => 'GS','created_at' => '2022-10-13 11:44:55','updated_at' => '2022-10-13 11:44:55','deleted_at' => NULL),
            array('name' => 'South Sudan','code' => 'SS','created_at' => '2022-10-13 11:44:56','updated_at' => '2022-10-13 11:44:56','deleted_at' => NULL),
            array('name' => 'Spain','code' => 'ES','created_at' => '2022-10-13 11:44:56','updated_at' => '2022-10-13 11:44:56','deleted_at' => NULL),
            array('name' => 'Sri Lanka','code' => 'LK','created_at' => '2022-10-13 11:45:01','updated_at' => '2022-10-13 11:45:01','deleted_at' => NULL),
            array('name' => 'Sudan','code' => 'SD','created_at' => '2022-10-13 11:45:02','updated_at' => '2022-10-13 11:45:02','deleted_at' => NULL),
            array('name' => 'Suriname','code' => 'SR','created_at' => '2022-10-13 11:45:04','updated_at' => '2022-10-13 11:45:04','deleted_at' => NULL),
            array('name' => 'Eswatini','code' => 'SZ','created_at' => '2022-10-13 11:45:05','updated_at' => '2022-10-13 11:45:05','deleted_at' => NULL),
            array('name' => 'Sweden','code' => 'SE','created_at' => '2022-10-13 11:45:05','updated_at' => '2022-10-13 11:45:05','deleted_at' => NULL),
            array('name' => 'Switzerland','code' => 'CH','created_at' => '2022-10-13 11:45:07','updated_at' => '2022-10-13 11:45:07','deleted_at' => NULL),
            array('name' => 'Syrian Arab Republic','code' => 'SY','created_at' => '2022-10-13 11:45:09','updated_at' => '2022-10-13 11:45:09','deleted_at' => NULL),
            array('name' => 'Taiwan','code' => 'TW','created_at' => '2022-10-13 11:45:10','updated_at' => '2022-10-13 11:45:10','deleted_at' => NULL),
            array('name' => 'Tajikistan','code' => 'TJ','created_at' => '2022-10-13 11:45:12','updated_at' => '2022-10-13 11:45:12','deleted_at' => NULL),
            array('name' => 'Tanzania, United Republic of','code' => 'TZ','created_at' => '2022-10-13 11:45:12','updated_at' => '2022-10-13 11:45:12','deleted_at' => NULL),
            array('name' => 'Thailand','code' => 'TH','created_at' => '2022-10-13 11:45:15','updated_at' => '2022-10-13 11:45:15','deleted_at' => NULL),
            array('name' => 'Timor-Leste','code' => 'TL','created_at' => '2022-10-13 11:45:23','updated_at' => '2022-10-13 11:45:23','deleted_at' => NULL),
            array('name' => 'Togo','code' => 'TG','created_at' => '2022-10-13 11:45:24','updated_at' => '2022-10-13 11:45:24','deleted_at' => NULL),
            array('name' => 'Tokelau','code' => 'TK','created_at' => '2022-10-13 11:45:24','updated_at' => '2022-10-13 11:45:24','deleted_at' => NULL),
            array('name' => 'Tonga','code' => 'TO','created_at' => '2022-10-13 11:45:25','updated_at' => '2022-10-13 11:45:25','deleted_at' => NULL),
            array('name' => 'Trinidad and Tobago','code' => 'TT','created_at' => '2022-10-13 11:45:25','updated_at' => '2022-10-13 11:45:25','deleted_at' => NULL),
            array('name' => 'Tunisia','code' => 'TN','created_at' => '2022-10-13 11:45:26','updated_at' => '2022-10-13 11:45:26','deleted_at' => NULL),
            array('name' => 'Turkey','code' => 'TR','created_at' => '2022-10-13 11:45:28','updated_at' => '2022-10-13 11:45:28','deleted_at' => NULL),
            array('name' => 'Turkmenistan','code' => 'TM','created_at' => '2022-10-13 11:45:36','updated_at' => '2022-10-13 11:45:36','deleted_at' => NULL),
            array('name' => 'Turks and Caicos Islands','code' => 'TC','created_at' => '2022-10-13 11:45:37','updated_at' => '2022-10-13 11:45:37','deleted_at' => NULL),
            array('name' => 'Tuvalu','code' => 'TV','created_at' => '2022-10-13 11:45:37','updated_at' => '2022-10-13 11:45:37','deleted_at' => NULL),
            array('name' => 'Uganda','code' => 'UG','created_at' => '2022-10-13 11:45:38','updated_at' => '2022-10-13 11:45:38','deleted_at' => NULL),
            array('name' => 'Ukraine','code' => 'UA','created_at' => '2022-10-13 11:45:44','updated_at' => '2022-10-13 11:45:44','deleted_at' => NULL),
            array('name' => 'United Arab Emirates','code' => 'AE','created_at' => '2022-10-13 11:45:45','updated_at' => '2022-10-13 11:45:45','deleted_at' => NULL),
            array('name' => 'United Kingdom','code' => 'GB','created_at' => '2022-10-13 11:52:50','updated_at' => '2022-10-13 11:52:50','deleted_at' => NULL),
            array('name' => 'United States','code' => 'US','created_at' => '2022-10-13 11:53:11','updated_at' => '2022-10-13 11:53:11','deleted_at' => NULL),
            array('name' => 'United States Minor Outlying Islands','code' => 'UM','created_at' => '2022-10-13 11:53:16','updated_at' => '2022-10-13 11:53:16','deleted_at' => NULL),
            array('name' => 'Uruguay','code' => 'UY','created_at' => '2022-10-13 11:53:17','updated_at' => '2022-10-13 11:53:17','deleted_at' => NULL),
            array('name' => 'Uzbekistan','code' => 'UZ','created_at' => '2022-10-13 11:53:18','updated_at' => '2022-10-13 11:53:18','deleted_at' => NULL),
            array('name' => 'Vanuatu','code' => 'VU','created_at' => '2022-10-13 11:53:20','updated_at' => '2022-10-13 11:53:20','deleted_at' => NULL),
            array('name' => 'Venezuela, Bolivarian Republic of','code' => 'VE','created_at' => '2022-10-13 11:53:20','updated_at' => '2022-10-13 11:53:20','deleted_at' => NULL),
            array('name' => 'Vietnam','code' => 'VN','created_at' => '2022-10-13 11:53:22','updated_at' => '2022-10-13 11:53:22','deleted_at' => NULL),
            array('name' => 'Virgin Islands, British','code' => 'VG','created_at' => '2022-10-13 11:53:26','updated_at' => '2022-10-13 11:53:26','deleted_at' => NULL),
            array('name' => 'Virgin Islands, U.S.','code' => 'VI','created_at' => '2022-10-13 11:53:27','updated_at' => '2022-10-13 11:53:27','deleted_at' => NULL),
            array('name' => 'Wallis and Futuna','code' => 'WF','created_at' => '2022-10-13 11:53:27','updated_at' => '2022-10-13 11:53:27','deleted_at' => NULL),
            array('name' => 'Western Sahara','code' => 'EH','created_at' => '2022-10-13 11:53:27','updated_at' => '2022-10-13 11:53:27','deleted_at' => NULL),
            array('name' => 'Yemen','code' => 'YE','created_at' => '2022-10-13 11:53:28','updated_at' => '2022-10-13 11:53:28','deleted_at' => NULL),
            array('name' => 'Zambia','code' => 'ZM','created_at' => '2022-10-13 11:53:29','updated_at' => '2022-10-13 11:53:29','deleted_at' => NULL),
            array('name' => 'Zimbabwe','code' => 'ZW','created_at' => '2022-10-13 11:53:30','updated_at' => '2022-10-13 11:53:30','deleted_at' => NULL)
        );

        DB::table('countries')->insert($countries);
    }
}
