<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view( 'user.index' )->with( [
            'users' => User::latest()->paginate( 10 ),
        ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view( 'user.create' )->with( 'countries', $this->countries_list );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        // validation
        $request->validate( [
            'name'     => ['required', 'max: 255', 'string'],
            'email'    => ['required', 'max: 255', 'string', 'email'],
            'password' => ['required', 'max: 255', 'confirmed'],
            'country'  => ['max: 255', 'string', 'not_in:none'],
            'company'  => ['max: 255', 'string'],
            'phone'    => ['max: 255', 'string'],
            'role'     => ['required', 'max: 255', 'string', 'not_in:none'],
        ] );

        $user = User::create( [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt( $request->password ),
            'country'  => $request->country,
            'company'  => $request->company,
            'phone'    => $request->phone,
            'role'     => $request->role,
        ] );
            $user->markEmailAsVerified();

        return redirect()->route( 'user.index' )->with( 'success', 'User Added Successfully' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( User $user ) {
        return view( 'user.edit' )->with( [
            'user'      => $user,
            'countries' => $this->countries_list,
        ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request ) {
        $request->validate( [
            'name'      => ['required', 'max:255', 'string'],
            'email'     => ['required', 'max:255', 'string', 'email'],
            'phone'     => ['max:255', 'string'],
            'company'   => ['max:255', 'string'],
            'country'   => ['max: 255', 'string', 'nullable'],
            'role'      => ['required', 'max:255', 'string'],
            'thumbnail' => 'image',
        ] );

        // get current user
        $user = User::find( Auth::id() );

        // get default thumbnail
        $thumb = $user->thumbnail;

        // update new thumbnail
        if ( !empty( $request->file( 'thumbnail' ) ) ) {
            Storage::delete( 'public/uploads/' . $thumb ); // delete the old image
            $filename = strtolower( str_replace( ' ', '-', $request->file( 'thumbnail' )->getClientOriginalName() ) );
            $thumb = time() . '-' . $filename;
            $request->file( 'thumbnail' )->storeAs( 'public/uploads', $thumb );
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'role' => $request->role,
            'thumbnail' => $thumb,
        ]);

        return redirect()->route('user.index')->with('success', 'User Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( User $user ) {
        if ( Auth::user()->role == 'admin' ) {
            if ( $user == Auth::user() ) {
                return redirect()->route( 'user.index' )->with( 'error', 'User is logged in, can\'t deleted' );
            } else {
                $user->delete();
                return redirect()->route( 'user.index' )->with( 'success', 'User Deleted' );
            }
        } else {
            return redirect()->route( 'user.index' )->with( 'error', 'You\'re not authorize to delete' );
        }
    }
    // country list
    public $countries_list = array(

        "Afghanistan",
        "Aland Islands",
        "Albania",
        "Algeria",
        "American Samoa",
        "Andorra",
        "Angola",
        "Anguilla",
        "Antarctica",
        "Antigua and Barbuda",
        "Argentina",
        "Armenia",
        "Aruba",
        "Australia",
        "Austria",
        "Azerbaijan",
        "Bahamas",
        "Bahrain",
        "Bangladesh",
        "Barbados",
        "Belarus",
        "Belgium",
        "Belize",
        "Benin",
        "Bermuda",
        "Bhutan",
        "Bolivia",
        "Bonaire, Sint Eustatius and Saba",
        "Bosnia and Herzegovina",
        "Botswana",
        "Bouvet Island",
        "Brazil",
        "British Indian Ocean Territory",
        "Brunei Darussalam",
        "Bulgaria",
        "Burkina Faso",
        "Burundi",
        "Cambodia",
        "Cameroon",
        "Canada",
        "Cape Verde",
        "Cayman Islands",
        "Central African Republic",
        "Chad",
        "Chile",
        "China",
        "Christmas Island",
        "Cocos (Keeling) Islands",
        "Colombia",
        "Comoros",
        "Congo",
        "Congo, Democratic Republic of the Congo",
        "Cook Islands",
        "Costa Rica",
        "Cote D'Ivoire",
        "Croatia",
        "Cuba",
        "Curacao",
        "Cyprus",
        "Czech Republic",
        "Denmark",
        "Djibouti",
        "Dominica",
        "Dominican Republic",
        "Ecuador",
        "Egypt",
        "El Salvador",
        "Equatorial Guinea",
        "Eritrea",
        "Estonia",
        "Ethiopia",
        "Falkland Islands (Malvinas)",
        "Faroe Islands",
        "Fiji",
        "Finland",
        "France",
        "French Guiana",
        "French Polynesia",
        "French Southern Territories",
        "Gabon",
        "Gambia",
        "Georgia",
        "Germany",
        "Ghana",
        "Gibraltar",
        "Greece",
        "Greenland",
        "Grenada",
        "Guadeloupe",
        "Guam",
        "Guatemala",
        "Guernsey",
        "Guinea",
        "Guinea-Bissau",
        "Guyana",
        "Haiti",
        "Heard Island and Mcdonald Islands",
        "Holy See (Vatican City State)",
        "Honduras",
        "Hong Kong",
        "Hungary",
        "Iceland",
        "India",
        "Indonesia",
        "Iran, Islamic Republic of",
        "Iraq",
        "Ireland",
        "Isle of Man",
        "Israel",
        "Italy",
        "Jamaica",
        "Japan",
        "Jersey",
        "Jordan",
        "Kazakhstan",
        "Kenya",
        "Kiribati",
        "Korea, Democratic People's Republic of",
        "Korea, Republic of",
        "Kosovo",
        "Kuwait",
        "Kyrgyzstan",
        "Lao People's Democratic Republic",
        "Latvia",
        "Lebanon",
        "Lesotho",
        "Liberia",
        "Libyan Arab Jamahiriya",
        "Liechtenstein",
        "Lithuania",
        "Luxembourg",
        "Macao",
        "Macedonia, the Former Yugoslav Republic of",
        "Madagascar",
        "Malawi",
        "Malaysia",
        "Maldives",
        "Mali",
        "Malta",
        "Marshall Islands",
        "Martinique",
        "Mauritania",
        "Mauritius",
        "Mayotte",
        "Mexico",
        "Micronesia, Federated States of",
        "Moldova, Republic of",
        "Monaco",
        "Mongolia",
        "Montenegro",
        "Montserrat",
        "Morocco",
        "Mozambique",
        "Myanmar",
        "Namibia",
        "Nauru",
        "Nepal",
        "Netherlands",
        "Netherlands Antilles",
        "New Caledonia",
        "New Zealand",
        "Nicaragua",
        "Niger",
        "Nigeria",
        "Niue",
        "Norfolk Island",
        "Northern Mariana Islands",
        "Norway",
        "Oman",
        "Pakistan",
        "Palau",
        "Palestinian Territory, Occupied",
        "Panama",
        "Papua New Guinea",
        "Paraguay",
        "Peru",
        "Philippines",
        "Pitcairn",
        "Poland",
        "Portugal",
        "Puerto Rico",
        "Qatar",
        "Reunion",
        "Romania",
        "Russian Federation",
        "Rwanda",
        "Saint Barthelemy",
        "Saint Helena",
        "Saint Kitts and Nevis",
        "Saint Lucia",
        "Saint Martin",
        "Saint Pierre and Miquelon",
        "Saint Vincent and the Grenadines",
        "Samoa",
        "San Marino",
        "Sao Tome and Principe",
        "Saudi Arabia",
        "Senegal",
        "Serbia",
        "Serbia and Montenegro",
        "Seychelles",
        "Sierra Leone",
        "Singapore",
        "Sint Maarten",
        "Slovakia",
        "Slovenia",
        "Solomon Islands",
        "Somalia",
        "South Africa",
        "South Georgia and the South Sandwich Islands",
        "South Sudan",
        "Spain",
        "Sri Lanka",
        "Sudan",
        "Suriname",
        "Svalbard and Jan Mayen",
        "Swaziland",
        "Sweden",
        "Switzerland",
        "Syrian Arab Republic",
        "Taiwan, Province of China",
        "Tajikistan",
        "Tanzania, United Republic of",
        "Thailand",
        "Timor-Leste",
        "Togo",
        "Tokelau",
        "Tonga",
        "Trinidad and Tobago",
        "Tunisia",
        "Turkey",
        "Turkmenistan",
        "Turks and Caicos Islands",
        "Tuvalu",
        "Uganda",
        "Ukraine",
        "United Arab Emirates",
        "United Kingdom",
        "United States",
        "United States Minor Outlying Islands",
        "Uruguay",
        "Uzbekistan",
        "Vanuatu",
        "Venezuela",
        "Viet Nam",
        "Virgin Islands, British",
        "Virgin Islands, U.s.",
        "Wallis and Futuna",
        "Western Sahara",
        "Yemen",
        "Zambia",
        "Zimbabwe",
    );
}
