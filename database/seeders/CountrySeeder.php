<?php

namespace Database\Seeders;

use App\Models\Zones\Country;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $now = Carbon::now();

        DB::table('countries')->delete();

        $path =  "database/data/country.json";
        $json = json_decode(file_get_contents($path), true);

        usort($json, function ($a, $b) { //Sort the array using a user defined function
            return $a['name']['common'] < $b['name']['common'] ? -1 : 1; //Compare the scores
        });

        foreach ($json as $js) {
            $code = $js['cca2'];
            try {

                $alt_name = [];

                if ($js['name']['official']) {
                    $alt_name[] = $js['name']['official'];
                }

                if ($js['altSpellings']) {
                    foreach ($js['altSpellings'] as $i) {
                        $alt_name[] = $i;
                    }
                }

                Country::create([
                    'code' => $code,
                    'name' => $js['name']['common'],
                    'search_keyword' => implode(',', $alt_name)
                ]);
            } catch (Exception $e) {
            }
        }


        // $countries = array(
        //     array('id' => 1, 'code' => 'AF', 'name' => "Afghanistan", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 2, 'code' => 'AL', 'name' => "Albania", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 3, 'code' => 'DZ', 'name' => "Algeria", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 4, 'code' => 'AS', 'name' => "American Samoa", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 5, 'code' => 'AD', 'name' => "Andorra", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 6, 'code' => 'AO', 'name' => "Angola", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 7, 'code' => 'AI', 'name' => "Anguilla", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 8, 'code' => 'AQ', 'name' => "Antarctica", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 9, 'code' => 'AG', 'name' => "Antigua And Barbuda", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 10, 'code' => 'AR', 'name' => "Argentina", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 11, 'code' => 'AM', 'name' => "Armenia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 12, 'code' => 'AW', 'name' => "Aruba", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 13, 'code' => 'AU', 'name' => "Australia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 14, 'code' => 'AT', 'name' => "Austria", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 15, 'code' => 'AZ', 'name' => "Azerbaijan", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 16, 'code' => 'BS', 'name' => "Bahamas The", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 17, 'code' => 'BH', 'name' => "Bahrain", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 18, 'code' => 'BD', 'name' => "Bangladesh", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 19, 'code' => 'BB', 'name' => "Barbados", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 20, 'code' => 'BY', 'name' => "Belarus", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 21, 'code' => 'BE', 'name' => "Belgium", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 22, 'code' => 'BZ', 'name' => "Belize", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 23, 'code' => 'BJ', 'name' => "Benin", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 24, 'code' => 'BM', 'name' => "Bermuda", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 25, 'code' => 'BT', 'name' => "Bhutan", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 26, 'code' => 'BO', 'name' => "Bolivia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 27, 'code' => 'BA', 'name' => "Bosnia and Herzegovina", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 28, 'code' => 'BW', 'name' => "Botswana", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 29, 'code' => 'BV', 'name' => "Bouvet Island", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 30, 'code' => 'BR', 'name' => "Brazil", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 31, 'code' => 'IO', 'name' => "British Indian Ocean Territory", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 32, 'code' => 'BN', 'name' => "Brunei", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 33, 'code' => 'BG', 'name' => "Bulgaria", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 34, 'code' => 'BF', 'name' => "Burkina Faso", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 35, 'code' => 'BI', 'name' => "Burundi", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 36, 'code' => 'KH', 'name' => "Cambodia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 37, 'code' => 'CM', 'name' => "Cameroon", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 38, 'code' => 'CA', 'name' => "Canada", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 39, 'code' => 'CV', 'name' => "Cape Verde", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 40, 'code' => 'KY', 'name' => "Cayman Islands", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 41, 'code' => 'CF', 'name' => "Central African Republic", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 42, 'code' => 'TD', 'name' => "Chad", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 43, 'code' => 'CL', 'name' => "Chile", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 44, 'code' => 'CN', 'name' => "China", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 45, 'code' => 'CX', 'name' => "Christmas Island", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 46, 'code' => 'CC', 'name' => "Cocos (Keeling) Islands", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 47, 'code' => 'CO', 'name' => "Colombia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 48, 'code' => 'KM', 'name' => "Comoros", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 49, 'code' => 'CG', 'name' => "Congo", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 50, 'code' => 'CD', 'name' => "Congo The Democratic Republic Of The", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 51, 'code' => 'CK', 'name' => "Cook Islands", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 52, 'code' => 'CR', 'name' => "Costa Rica", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 53, 'code' => 'CI', 'name' => "Cote D Ivoire (Ivory Coast)", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 54, 'code' => 'HR', 'name' => "Croatia (Hrvatska)", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 55, 'code' => 'CU', 'name' => "Cuba", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 56, 'code' => 'CY', 'name' => "Cyprus", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 57, 'code' => 'CZ', 'name' => "Czech Republic", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 58, 'code' => 'DK', 'name' => "Denmark", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 59, 'code' => 'DJ', 'name' => "Djibouti", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 60, 'code' => 'DM', 'name' => "Dominica", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 61, 'code' => 'DO', 'name' => "Dominican Republic", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 62, 'code' => 'TP', 'name' => "East Timor", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 63, 'code' => 'EC', 'name' => "Ecuador", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 64, 'code' => 'EG', 'name' => "Egypt", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 65, 'code' => 'SV', 'name' => "El Salvador", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 66, 'code' => 'GQ', 'name' => "Equatorial Guinea", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 67, 'code' => 'ER', 'name' => "Eritrea", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 68, 'code' => 'EE', 'name' => "Estonia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 69, 'code' => 'ET', 'name' => "Ethiopia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 70, 'code' => 'XA', 'name' => "External Territories of Australia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 71, 'code' => 'FK', 'name' => "Falkland Islands", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 72, 'code' => 'FO', 'name' => "Faroe Islands", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 73, 'code' => 'FJ', 'name' => "Fiji Islands", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 74, 'code' => 'FI', 'name' => "Finland", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 75, 'code' => 'FR', 'name' => "France", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 76, 'code' => 'GF', 'name' => "French Guiana", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 77, 'code' => 'PF', 'name' => "French Polynesia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 78, 'code' => 'TF', 'name' => "French Southern Territories", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 79, 'code' => 'GA', 'name' => "Gabon", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 80, 'code' => 'GM', 'name' => "Gambia The", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 81, 'code' => 'GE', 'name' => "Georgia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 82, 'code' => 'DE', 'name' => "Germany", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 83, 'code' => 'GH', 'name' => "Ghana", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 84, 'code' => 'GI', 'name' => "Gibraltar", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 85, 'code' => 'GR', 'name' => "Greece", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 86, 'code' => 'GL', 'name' => "Greenland", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 87, 'code' => 'GD', 'name' => "Grenada", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 88, 'code' => 'GP', 'name' => "Guadeloupe", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 89, 'code' => 'GU', 'name' => "Guam", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 90, 'code' => 'GT', 'name' => "Guatemala", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 91, 'code' => 'XU', 'name' => "Guernsey and Alderney", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 92, 'code' => 'GN', 'name' => "Guinea", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 93, 'code' => 'GW', 'name' => "Guinea-Bissau", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 94, 'code' => 'GY', 'name' => "Guyana", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 95, 'code' => 'HT', 'name' => "Haiti", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 96, 'code' => 'HM', 'name' => "Heard and McDonald Islands", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 97, 'code' => 'HN', 'name' => "Honduras", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 98, 'code' => 'HK', 'name' => "Hong Kong S.A.R.", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 99, 'code' => 'HU', 'name' => "Hungary", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 100, 'code' => 'IS', 'name' => "Iceland", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 101, 'code' => 'IN', 'name' => "India", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 102, 'code' => 'ID', 'name' => "Indonesia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 103, 'code' => 'IR', 'name' => "Iran", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 104, 'code' => 'IQ', 'name' => "Iraq", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 105, 'code' => 'IE', 'name' => "Ireland", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 106, 'code' => 'IL', 'name' => "Israel", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 107, 'code' => 'IT', 'name' => "Italy", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 108, 'code' => 'JM', 'name' => "Jamaica", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 109, 'code' => 'JP', 'name' => "Japan", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 110, 'code' => 'XJ', 'name' => "Jersey", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 111, 'code' => 'JO', 'name' => "Jordan", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 112, 'code' => 'KZ', 'name' => "Kazakhstan", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 113, 'code' => 'KE', 'name' => "Kenya", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 114, 'code' => 'KI', 'name' => "Kiribati", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 115, 'code' => 'KP', 'name' => "Korea North", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 116, 'code' => 'KR', 'name' => "Korea South", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 117, 'code' => 'KW', 'name' => "Kuwait", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 118, 'code' => 'KG', 'name' => "Kyrgyzstan", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 119, 'code' => 'LA', 'name' => "Laos", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 120, 'code' => 'LV', 'name' => "Latvia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 121, 'code' => 'LB', 'name' => "Lebanon", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 122, 'code' => 'LS', 'name' => "Lesotho", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 123, 'code' => 'LR', 'name' => "Liberia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 124, 'code' => 'LY', 'name' => "Libya", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 125, 'code' => 'LI', 'name' => "Liechtenstein", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 126, 'code' => 'LT', 'name' => "Lithuania", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 127, 'code' => 'LU', 'name' => "Luxembourg", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 128, 'code' => 'MO', 'name' => "Macau S.A.R.", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 129, 'code' => 'MK', 'name' => "Macedonia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 130, 'code' => 'MG', 'name' => "Madagascar", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 131, 'code' => 'MW', 'name' => "Malawi", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 132, 'code' => 'MY', 'name' => "Malaysia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 133, 'code' => 'MV', 'name' => "Maldives", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 134, 'code' => 'ML', 'name' => "Mali", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 135, 'code' => 'MT', 'name' => "Malta", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 136, 'code' => 'XM', 'name' => "Man (Isle of)", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 137, 'code' => 'MH', 'name' => "Marshall Islands", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 138, 'code' => 'MQ', 'name' => "Martinique", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 139, 'code' => 'MR', 'name' => "Mauritania", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 140, 'code' => 'MU', 'name' => "Mauritius", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 141, 'code' => 'YT', 'name' => "Mayotte", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 142, 'code' => 'MX', 'name' => "Mexico", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 143, 'code' => 'FM', 'name' => "Micronesia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 144, 'code' => 'MD', 'name' => "Moldova", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 145, 'code' => 'MC', 'name' => "Monaco", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 146, 'code' => 'MN', 'name' => "Mongolia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 147, 'code' => 'MS', 'name' => "Montserrat", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 148, 'code' => 'MA', 'name' => "Morocco", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 149, 'code' => 'MZ', 'name' => "Mozambique", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 150, 'code' => 'MM', 'name' => "Myanmar", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 151, 'code' => 'NA', 'name' => "Namibia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 152, 'code' => 'NR', 'name' => "Nauru", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 153, 'code' => 'NP', 'name' => "Nepal", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 154, 'code' => 'AN', 'name' => "Netherlands Antilles", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 155, 'code' => 'NL', 'name' => "Netherlands The", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 156, 'code' => 'NC', 'name' => "New Caledonia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 157, 'code' => 'NZ', 'name' => "New Zealand", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 158, 'code' => 'NI', 'name' => "Nicaragua", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 159, 'code' => 'NE', 'name' => "Niger", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 160, 'code' => 'NG', 'name' => "Nigeria", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 161, 'code' => 'NU', 'name' => "Niue", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 162, 'code' => 'NF', 'name' => "Norfolk Island", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 163, 'code' => 'MP', 'name' => "Northern Mariana Islands", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 164, 'code' => 'NO', 'name' => "Norway", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 165, 'code' => 'OM', 'name' => "Oman", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 166, 'code' => 'PK', 'name' => "Pakistan", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 167, 'code' => 'PW', 'name' => "Palau", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 168, 'code' => 'PS', 'name' => "Palestinian Territory Occupied", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 169, 'code' => 'PA', 'name' => "Panama", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 170, 'code' => 'PG', 'name' => "Papua new Guinea", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 171, 'code' => 'PY', 'name' => "Paraguay", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 172, 'code' => 'PE', 'name' => "Peru", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 173, 'code' => 'PH', 'name' => "Philippines", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 174, 'code' => 'PN', 'name' => "Pitcairn Island", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 175, 'code' => 'PL', 'name' => "Poland", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 176, 'code' => 'PT', 'name' => "Portugal", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 177, 'code' => 'PR', 'name' => "Puerto Rico", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 178, 'code' => 'QA', 'name' => "Qatar", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 179, 'code' => 'RE', 'name' => "Reunion", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 180, 'code' => 'RO', 'name' => "Romania", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 181, 'code' => 'RU', 'name' => "Russia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 182, 'code' => 'RW', 'name' => "Rwanda", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 183, 'code' => 'SH', 'name' => "Saint Helena", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 184, 'code' => 'KN', 'name' => "Saint Kitts And Nevis", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 185, 'code' => 'LC', 'name' => "Saint Lucia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 186, 'code' => 'PM', 'name' => "Saint Pierre and Miquelon", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 187, 'code' => 'VC', 'name' => "Saint Vincent And The Grenadines", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 188, 'code' => 'WS', 'name' => "Samoa", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 189, 'code' => 'SM', 'name' => "San Marino", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 190, 'code' => 'ST', 'name' => "Sao Tome and Principe", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 191, 'code' => 'SA', 'name' => "Saudi Arabia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 192, 'code' => 'SN', 'name' => "Senegal", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 193, 'code' => 'RS', 'name' => "Serbia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 194, 'code' => 'SC', 'name' => "Seychelles", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 195, 'code' => 'SL', 'name' => "Sierra Leone", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 196, 'code' => 'SG', 'name' => "Singapore", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 197, 'code' => 'SK', 'name' => "Slovakia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 198, 'code' => 'SI', 'name' => "Slovenia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 199, 'code' => 'XG', 'name' => "Smaller Territories of the UK", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 200, 'code' => 'SB', 'name' => "Solomon Islands", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 201, 'code' => 'SO', 'name' => "Somalia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 202, 'code' => 'ZA', 'name' => "South Africa", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 203, 'code' => 'GS', 'name' => "South Georgia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 204, 'code' => 'SS', 'name' => "South Sudan", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 205, 'code' => 'ES', 'name' => "Spain", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 206, 'code' => 'LK', 'name' => "Sri Lanka", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 207, 'code' => 'SD', 'name' => "Sudan", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 208, 'code' => 'SR', 'name' => "Suriname", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 209, 'code' => 'SJ', 'name' => "Svalbard And Jan Mayen Islands", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 210, 'code' => 'SZ', 'name' => "Swaziland", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 211, 'code' => 'SE', 'name' => "Sweden", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 212, 'code' => 'CH', 'name' => "Switzerland", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 213, 'code' => 'SY', 'name' => "Syria", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 214, 'code' => 'TW', 'name' => "Taiwan", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 215, 'code' => 'TJ', 'name' => "Tajikistan", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 216, 'code' => 'TZ', 'name' => "Tanzania", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 217, 'code' => 'TH', 'name' => "Thailand", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 218, 'code' => 'TG', 'name' => "Togo", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 219, 'code' => 'TK', 'name' => "Tokelau", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 220, 'code' => 'TO', 'name' => "Tonga", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 221, 'code' => 'TT', 'name' => "Trinidad And Tobago", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 222, 'code' => 'TN', 'name' => "Tunisia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 223, 'code' => 'TR', 'name' => "Turkey", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 224, 'code' => 'TM', 'name' => "Turkmenistan", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 225, 'code' => 'TC', 'name' => "Turks And Caicos Islands", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 226, 'code' => 'TV', 'name' => "Tuvalu", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 227, 'code' => 'UG', 'name' => "Uganda", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 228, 'code' => 'UA', 'name' => "Ukraine", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 229, 'code' => 'AE', 'name' => "United Arab Emirates", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 230, 'code' => 'GB', 'name' => "United Kingdom", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 231, 'code' => 'US', 'name' => "United States", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 232, 'code' => 'UM', 'name' => "United States Minor Outlying Islands", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 233, 'code' => 'UY', 'name' => "Uruguay", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 234, 'code' => 'UZ', 'name' => "Uzbekistan", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 235, 'code' => 'VU', 'name' => "Vanuatu", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 236, 'code' => 'VA', 'name' => "Vatican City State (Holy See)", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 237, 'code' => 'VE', 'name' => "Venezuela", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 238, 'code' => 'VN', 'name' => "Vietnam", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 239, 'code' => 'VG', 'name' => "Virgin Islands (British)", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 240, 'code' => 'VI', 'name' => "Virgin Islands (US)", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 241, 'code' => 'WF', 'name' => "Wallis And Futuna Islands", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 242, 'code' => 'EH', 'name' => "Western Sahara", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 243, 'code' => 'YE', 'name' => "Yemen", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 244, 'code' => 'YU', 'name' => "Yugoslavia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 245, 'code' => 'ZM', 'name' => "Zambia", 'created_at' => $now, 'updated_at' => $now),
        //     array('id' => 246, 'code' => 'ZW', 'name' => "Zimbabwe", 'created_at' => $now, 'updated_at' => $now),
        // );

        // DB::table('countries')->insert($countries);
    }
}
