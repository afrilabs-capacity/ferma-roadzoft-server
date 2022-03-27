<?php

use Illuminate\Support\Facades\Route;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {


    //    return (new App\Notifications\AccountVerification(App\Models\User::find(1)))
    //   ->toMail(App\Models\User::find(1));

  // $data = '[
  //     {
  //       "Abia": [
  //         "Aba North",
  //         "Aba South",
  //         "Arochukwu",
  //         "Bende",
  //         "Ikwuano",
  //         "Isiala-Ngwa North",
  //         "Isiala-Ngwa South",
  //         "Isuikwato",
  //         "Obi Nwa",
  //         "Ohafia",
  //         "Osisioma",
  //         "Ngwa",
  //         "Ugwunagbo",
  //         "Ukwa East",
  //         "Ukwa West",
  //         "Umuahia North",
  //         "Umuahia South",
  //         "Umu-Neochi"
  //       ],
  //       "Adamawa": [
  //         "Demsa",
  //         "Fufore",
  //         "Ganaye",
  //         "Gireri",
  //         "Gombi",
  //         "Guyuk",
  //         "Hong",
  //         "Jada",
  //         "Lamurde",
  //         "Madagali",
  //         "Maiha",
  //         "Mayo-Belwa",
  //         "Michika",
  //         "Mubi North",
  //         "Mubi South",
  //         "Numan",
  //         "Shelleng",
  //         "Song",
  //         "Toungo",
  //         "Yola North",
  //         "Yola South"
  //       ],
  //       "Anambra": [
  //         "Aguata",
  //         "Anambra East",
  //         "Anambra West",
  //         "Anaocha",
  //         "Awka North",
  //         "Awka South",
  //         "Ayamelum",
  //         "Dunukofia",
  //         "Ekwusigo",
  //         "Idemili North",
  //         "Idemili south",
  //         "Ihiala",
  //         "Njikoka",
  //         "Nnewi North",
  //         "Nnewi South",
  //         "Ogbaru",
  //         "Onitsha North",
  //         "Onitsha South",
  //         "Orumba North",
  //         "Orumba South",
  //         "Oyi"
  //       ],
  //       "Akwa Ibom": [
  //         "Abak",
  //         "Eastern Obolo",
  //         "Eket",
  //         "Esit Eket",
  //         "Essien Udim",
  //         "Etim Ekpo",
  //         "Etinan",
  //         "Ibeno",
  //         "Ibesikpo Asutan",
  //         "Ibiono Ibom",
  //         "Ika",
  //         "Ikono",
  //         "Ikot Abasi",
  //         "Ikot Ekpene",
  //         "Ini",
  //         "Itu",
  //         "Mbo",
  //         "Mkpat Enin",
  //         "Nsit Atai",
  //         "Nsit Ibom",
  //         "Nsit Ubium",
  //         "Obot Akara",
  //         "Okobo",
  //         "Onna",
  //         "Oron",
  //         "Oruk Anam",
  //         "Udung Uko",
  //         "Ukanafun",
  //         "Uruan",
  //         "Urue-Offong/Oruko ",
  //         "Uyo"
  //       ],
  //       "Bauchi": [
  //         "Alkaleri",
  //         "Bauchi",
  //         "Bogoro",
  //         "Damban",
  //         "Darazo",
  //         "Dass",
  //         "Ganjuwa",
  //         "Giade",
  //         "Itas/Gadau",
  //         "Jama\'are",
  //         "Katagum",
  //         "Kirfi",
  //         "Misau",
  //         "Ningi",
  //         "Shira",
  //         "Tafawa-Balewa",
  //         "Toro",
  //         "Warji",
  //         "Zaki"
  //       ],
  //       "Bayelsa": [
  //         "Brass",
  //         "Ekeremor",
  //         "Kolokuma/Opokuma",
  //         "Nembe",
  //         "Ogbia",
  //         "Sagbama",
  //         "Southern Jaw",
  //         "Yenegoa"
  //       ],
  //       "Benue": [
  //         "Ado",
  //         "Agatu",
  //         "Apa",
  //         "Buruku",
  //         "Gboko",
  //         "Guma",
  //         "Gwer East",
  //         "Gwer West",
  //         "Katsina-Ala",
  //         "Konshisha",
  //         "Kwande",
  //         "Logo",
  //         "Makurdi",
  //         "Obi",
  //         "Ogbadibo",
  //         "Oju",
  //         "Okpokwu",
  //         "Ohimini",
  //         "Oturkpo",
  //         "Tarka",
  //         "Ukum",
  //         "Ushongo",
  //         "Vandeikya"
  //       ],
  //       "Borno": [
  //         "Abadam",
  //         "Askira/Uba",
  //         "Bama",
  //         "Bayo",
  //         "Biu",
  //         "Chibok",
  //         "Damboa",
  //         "Dikwa",
  //         "Gubio",
  //         "Guzamala",
  //         "Gwoza",
  //         "Hawul",
  //         "Jere",
  //         "Kaga",
  //         "Kala/Balge",
  //         "Konduga",
  //         "Kukawa",
  //         "Kwaya Kusar",
  //         "Mafa",
  //         "Magumeri",
  //         "Maiduguri",
  //         "Marte",
  //         "Mobbar",
  //         "Monguno",
  //         "Ngala",
  //         "Nganzai",
  //         "Shani"
  //       ],
  //       "Cross River": [
  //         "Akpabuyo",
  //         "Odukpani",
  //         "Akamkpa",
  //         "Biase",
  //         "Abi",
  //         "Ikom",
  //         "Yarkur",
  //         "Odubra",
  //         "Boki",
  //         "Ogoja",
  //         "Yala",
  //         "Obanliku",
  //         "Obudu",
  //         "Calabar South",
  //         "Etung",
  //         "Bekwara",
  //         "Bakassi",
  //         "Calabar Municipality"
  //       ],
  //       "Delta": [
  //         "Oshimili",
  //         "Aniocha",
  //         "Aniocha South",
  //         "Ika South",
  //         "Ika North-East",
  //         "Ndokwa West",
  //         "Ndokwa East",
  //         "Isoko south",
  //         "Isoko North",
  //         "Bomadi",
  //         "Burutu",
  //         "Ughelli South",
  //         "Ughelli North",
  //         "Ethiope West",
  //         "Ethiope East",
  //         "Sapele",
  //         "Okpe",
  //         "Warri North",
  //         "Warri South",
  //         "Uvwie",
  //         "Udu",
  //         "Warri Central",
  //         "Ukwani",
  //         "Oshimili North",
  //         "Patani"
  //       ],
  //       "Ebonyi": [
  //         "Afikpo South",
  //         "Afikpo North",
  //         "Onicha",
  //         "Ohaozara",
  //         "Abakaliki",
  //         "Ishielu",
  //         "lkwo",
  //         "Ezza",
  //         "Ezza South",
  //         "Ohaukwu",
  //         "Ebonyi",
  //         "Ivo"
  //       ],
  //       "Enugu": [
  //         "Enugu South,",
  //         "Igbo-Eze South",
  //         "Enugu North",
  //         "Nkanu",
  //         "Udi Agwu",
  //         "Oji-River",
  //         "Ezeagu",
  //         "IgboEze North",
  //         "Isi-Uzo",
  //         "Nsukka",
  //         "Igbo-Ekiti",
  //         "Uzo-Uwani",
  //         "Enugu Eas",
  //         "Aninri",
  //         "Nkanu East",
  //         "Udenu."
  //       ],
  //       "Edo": [
  //         "Esan North-East",
  //         "Esan Central",
  //         "Esan West",
  //         "Egor",
  //         "Ukpoba",
  //         "Central",
  //         "Etsako Central",
  //         "Igueben",
  //         "Oredo",
  //         "Ovia SouthWest",
  //         "Ovia South-East",
  //         "Orhionwon",
  //         "Uhunmwonde",
  //         "Etsako East",
  //         "Esan South-East"
  //       ],
  //       "Ekiti": [
  //         "Ado",
  //         "Ekiti-East",
  //         "Ekiti-West",
  //         "Emure/Ise/Orun",
  //         "Ekiti South-West",
  //         "Ikere Ekiti",
  //         "Irepodun",
  //         "Ijero,",
  //         "Ido/Osi",
  //         "Oye",
  //         "Ikole",
  //         "Moba",
  //         "Gbonyin",
  //         "Efon",
  //         "Ise/Orun",
  //         "Ilejemeje."
  //       ],
  //       "FCT - Abuja": [
  //         "Abaji",
  //         "Abuja Municipal",
  //         "Bwari",
  //         "Gwagwalada",
  //         "Kuje",
  //         "Kwali"
  //       ],
  //       "Gombe": [
  //         "Akko",
  //         "Balanga",
  //         "Billiri",
  //         "Dukku",
  //         "Kaltungo",
  //         "Kwami",
  //         "Shomgom",
  //         "Funakaye",
  //         "Gombe",
  //         "Nafada/Bajoga",
  //         "Yamaltu/Delta."
  //       ],
  //       "Imo": [
  //         "Aboh-Mbaise",
  //         "Ahiazu-Mbaise",
  //         "Ehime-Mbano",
  //         "Ezinihitte",
  //         "Ideato North",
  //         "Ideato South",
  //         "Ihitte/Uboma",
  //         "Ikeduru",
  //         "Isiala Mbano",
  //         "Isu",
  //         "Mbaitoli",
  //         "Mbaitoli",
  //         "Ngor-Okpala",
  //         "Njaba",
  //         "Nwangele",
  //         "Nkwerre",
  //         "Obowo",
  //         "Oguta",
  //         "Ohaji/Egbema",
  //         "Okigwe",
  //         "Orlu",
  //         "Orsu",
  //         "Oru East",
  //         "Oru West",
  //         "Owerri-Municipal",
  //         "Owerri North",
  //         "Owerri West"
  //       ],
  //       "Jigawa": [
  //         "Auyo",
  //         "Babura",
  //         "Birni Kudu",
  //         "Biriniwa",
  //         "Buji",
  //         "Dutse",
  //         "Gagarawa",
  //         "Garki",
  //         "Gumel",
  //         "Guri",
  //         "Gwaram",
  //         "Gwiwa",
  //         "Hadejia",
  //         "Jahun",
  //         "Kafin Hausa",
  //         "Kaugama Kazaure",
  //         "Kiri Kasamma",
  //         "Kiyawa",
  //         "Maigatari",
  //         "Malam Madori",
  //         "Miga",
  //         "Ringim",
  //         "Roni",
  //         "Sule-Tankarkar",
  //         "Taura",
  //         "Yankwashi"
  //       ],
  //       "Kaduna": [
  //         "Birni-Gwari",
  //         "Chikun",
  //         "Giwa",
  //         "Igabi",
  //         "Ikara",
  //         "jaba",
  //         "Jema\'a",
  //         "Kachia",
  //         "Kaduna North",
  //         "Kaduna South",
  //         "Kagarko",
  //         "Kajuru",
  //         "Kaura",
  //         "Kauru",
  //         "Kubau",
  //         "Kudan",
  //         "Lere",
  //         "Makarfi",
  //         "Sabon-Gari",
  //         "Sanga",
  //         "Soba",
  //         "Zango-Kataf",
  //         "Zaria"
  //       ],
  //       "Kano": [
  //         "Ajingi",
  //         "Albasu",
  //         "Bagwai",
  //         "Bebeji",
  //         "Bichi",
  //         "Bunkure",
  //         "Dala",
  //         "Dambatta",
  //         "Dawakin Kudu",
  //         "Dawakin Tofa",
  //         "Doguwa",
  //         "Fagge",
  //         "Gabasawa",
  //         "Garko",
  //         "Garum",
  //         "Mallam",
  //         "Gaya",
  //         "Gezawa",
  //         "Gwale",
  //         "Gwarzo",
  //         "Kabo",
  //         "Kano Municipal",
  //         "Karaye",
  //         "Kibiya",
  //         "Kiru",
  //         "kumbotso",
  //         "Kunchi",
  //         "Kura",
  //         "Madobi",
  //         "Makoda",
  //         "Minjibir",
  //         "Nasarawa",
  //         "Rano",
  //         "Rimin Gado",
  //         "Rogo",
  //         "Shanono",
  //         "Sumaila",
  //         "Takali",
  //         "Tarauni",
  //         "Tofa",
  //         "Tsanyawa",
  //         "Tudun Wada",
  //         "Ungogo",
  //         "Warawa",
  //         "Wudil"
  //       ],
  //       "Katsina": [
  //         "Bakori",
  //         "Batagarawa",
  //         "Batsari",
  //         "Baure",
  //         "Bindawa",
  //         "Charanchi",
  //         "Dandume",
  //         "Danja",
  //         "Dan Musa",
  //         "Daura",
  //         "Dutsi",
  //         "Dutsin-Ma",
  //         "Faskari",
  //         "Funtua",
  //         "Ingawa",
  //         "Jibia",
  //         "Kafur",
  //         "Kaita",
  //         "Kankara",
  //         "Kankia",
  //         "Katsina",
  //         "Kurfi",
  //         "Kusada",
  //         "Mai\'Adua",
  //         "Malumfashi",
  //         "Mani",
  //         "Mashi",
  //         "Matazuu",
  //         "Musawa",
  //         "Rimi",
  //         "Sabuwa",
  //         "Safana",
  //         "Sandamu",
  //         "Zango"
  //       ],
  //       "Kebbi": [
  //         "Aleiro",
  //         "Arewa-Dandi",
  //         "Argungu",
  //         "Augie",
  //         "Bagudo",
  //         "Birnin Kebbi",
  //         "Bunza",
  //         "Dandi",
  //         "Fakai",
  //         "Gwandu",
  //         "Jega",
  //         "Kalgo",
  //         "Koko/Besse",
  //         "Maiyama",
  //         "Ngaski",
  //         "Sakaba",
  //         "Shanga",
  //         "Suru",
  //         "Wasagu/Danko",
  //         "Yauri",
  //         "Zuru"
  //       ],
  //       "Kogi": [
  //         "Adavi",
  //         "Ajaokuta",
  //         "Ankpa",
  //         "Bassa",
  //         "Dekina",
  //         "Ibaji",
  //         "Idah",
  //         "Igalamela-Odolu",
  //         "Ijumu",
  //         "Kabba/Bunu",
  //         "Kogi",
  //         "Lokoja",
  //         "Mopa-Muro",
  //         "Ofu",
  //         "Ogori/Mangongo",
  //         "Okehi",
  //         "Okene",
  //         "Olamabolo",
  //         "Omala",
  //         "Yagba East",
  //         "Yagba West"
  //       ],
  //       "Kwara": [
  //         "Asa",
  //         "Baruten",
  //         "Edu",
  //         "Ekiti",
  //         "Ifelodun",
  //         "Ilorin East",
  //         "Ilorin West",
  //         "Irepodun",
  //         "Isin",
  //         "Kaiama",
  //         "Moro",
  //         "Offa",
  //         "Oke-Ero",
  //         "Oyun",
  //         "Pategi"
  //       ],
  //       "Lagos": [
  //         "Agege",
  //         "Ajeromi-Ifelodun",
  //         "Alimosho",
  //         "Amuwo-Odofin",
  //         "Apapa",
  //         "Badagry",
  //         "Epe",
  //         "Eti-Osa",
  //         "Ibeju/Lekki",
  //         "Ifako-Ijaye",
  //         "Ikeja",
  //         "Ikorodu",
  //         "Kosofe",
  //         "Lagos Island",
  //         "Lagos Mainland",
  //         "Mushin",
  //         "Ojo",
  //         "Oshodi-Isolo",
  //         "Shomolu",
  //         "Surulere"
  //       ],
  //       "Nasarawa": [
  //         "Akwanga",
  //         "Awe",
  //         "Doma",
  //         "Karu",
  //         "Keana",
  //         "Keffi",
  //         "Kokona",
  //         "Lafia",
  //         "Nasarawa",
  //         "Nasarawa-Eggon",
  //         "Obi",
  //         "Toto",
  //         "Wamba"
  //       ],
  //       "Niger": [
  //         "Agaie",
  //         "Agwara",
  //         "Bida",
  //         "Borgu",
  //         "Bosso",
  //         "Chanchaga",
  //         "Edati",
  //         "Gbako",
  //         "Gurara",
  //         "Katcha",
  //         "Kontagora",
  //         "Lapai",
  //         "Lavun",
  //         "Magama",
  //         "Mariga",
  //         "Mashegu",
  //         "Mokwa",
  //         "Muya",
  //         "Pailoro",
  //         "Rafi",
  //         "Rijau",
  //         "Shiroro",
  //         "Suleja",
  //         "Tafa",
  //         "Wushishi"
  //       ],
  //       "Ogun": [
  //         "Abeokuta North",
  //         "Abeokuta South",
  //         "Ado-Odo/Ota",
  //         "Egbado North",
  //         "Egbado South",
  //         "Ewekoro",
  //         "Ifo",
  //         "Ijebu East",
  //         "Ijebu North",
  //         "Ijebu North East",
  //         "Ijebu Ode",
  //         "Ikenne",
  //         "Imeko-Afon",
  //         "Ipokia",
  //         "Obafemi-Owode",
  //         "Ogun Waterside",
  //         "Odeda",
  //         "Odogbolu",
  //         "Remo North",
  //         "Shagamu"
  //       ],
  //       "Ondo": [
  //         "Akoko North East",
  //         "Akoko North West",
  //         "Akoko South Akure East",
  //         "Akoko South West",
  //         "Akure North",
  //         "Akure South",
  //         "Ese-Odo",
  //         "Idanre",
  //         "Ifedore",
  //         "Ilaje",
  //         "Ile-Oluji",
  //         "Okeigbo",
  //         "Irele",
  //         "Odigbo",
  //         "Okitipupa",
  //         "Ondo East",
  //         "Ondo West",
  //         "Ose",
  //         "Owo"
  //       ],
  //       "Osun": [
  //         "Aiyedade",
  //         "Aiyedire",
  //         "Atakumosa East",
  //         "Atakumosa West",
  //         "Boluwaduro",
  //         "Boripe",
  //         "Ede North",
  //         "Ede South",
  //         "Egbedore",
  //         "Ejigbo",
  //         "Ife Central",
  //         "Ife East",
  //         "Ife North",
  //         "Ife South",
  //         "Ifedayo",
  //         "Ifelodun",
  //         "Ila",
  //         "Ilesha East",
  //         "Ilesha West",
  //         "Irepodun",
  //         "Irewole",
  //         "Isokan",
  //         "Iwo",
  //         "Obokun",
  //         "Odo-Otin",
  //         "Ola-Oluwa",
  //         "Olorunda",
  //         "Oriade",
  //         "Orolu",
  //         "Osogbo"
  //       ],
  //       "Oyo": [
  //         "Afijio",
  //         "Akinyele",
  //         "Atiba",
  //         "Atigbo",
  //         "Egbeda",
  //         "Ibadan Central",
  //         "Ibadan North",
  //         "Ibadan North West",
  //         "Ibadan South East",
  //         "Ibadan South West",
  //         "Ibarapa Central",
  //         "Ibarapa East",
  //         "Ibarapa North",
  //         "Ido",
  //         "Irepo",
  //         "Iseyin",
  //         "Itesiwaju",
  //         "Iwajowa",
  //         "Kajola",
  //         "Lagelu Ogbomosho North",
  //         "Ogbomosho South",
  //         "Ogo Oluwa",
  //         "Olorunsogo",
  //         "Oluyole",
  //         "Ona-Ara",
  //         "Orelope",
  //         "Ori Ire",
  //         "Oyo East",
  //         "Oyo West",
  //         "Saki East",
  //         "Saki West",
  //         "Surulere"
  //       ],
  //       "Plateau": [
  //         "Barikin Ladi",
  //         "Bassa",
  //         "Bokkos",
  //         "Jos East",
  //         "Jos North",
  //         "Jos South",
  //         "Kanam",
  //         "Kanke",
  //         "Langtang North",
  //         "Langtang South",
  //         "Mangu",
  //         "Mikang",
  //         "Pankshin",
  //         "Qua\'an Pan",
  //         "Riyom",
  //         "Shendam",
  //         "Wase"
  //       ],
  //       "Rivers": [
  //         "Abua/Odual",
  //         "Ahoada East",
  //         "Ahoada West",
  //         "Akuku Toru",
  //         "Andoni",
  //         "Asari-Toru",
  //         "Bonny",
  //         "Degema",
  //         "Emohua",
  //         "Eleme",
  //         "Etche",
  //         "Gokana",
  //         "Ikwerre",
  //         "Khana",
  //         "Obia/Akpor",
  //         "Ogba/Egbema/Ndoni",
  //         "Ogu/Bolo",
  //         "Okrika",
  //         "Omumma",
  //         "Opobo/Nkoro",
  //         "Oyigbo",
  //         "Port-Harcourt",
  //         "Tai"
  //       ],
  //       "Sokoto": [
  //         "Binji",
  //         "Bodinga",
  //         "Dange-shnsi",
  //         "Gada",
  //         "Goronyo",
  //         "Gudu",
  //         "Gawabawa",
  //         "Illela",
  //         "Isa",
  //         "Kware",
  //         "kebbe",
  //         "Rabah",
  //         "Sabon birni",
  //         "Shagari",
  //         "Silame",
  //         "Sokoto North",
  //         "Sokoto South",
  //         "Tambuwal",
  //         "Tqngaza",
  //         "Tureta",
  //         "Wamako",
  //         "Wurno",
  //         "Yabo"
  //       ],
  //       "Taraba": [
  //         "Ardo-kola",
  //         "Bali",
  //         "Donga",
  //         "Gashaka",
  //         "Cassol",
  //         "Ibi",
  //         "Jalingo",
  //         "Karin-Lamido",
  //         "Kurmi",
  //         "Lau",
  //         "Sardauna",
  //         "Takum",
  //         "Ussa",
  //         "Wukari",
  //         "Yorro",
  //         "Zing"
  //       ],
  //       "Yobe": [
  //         "Bade",
  //         "Bursari",
  //         "Damaturu",
  //         "Fika",
  //         "Fune",
  //         "Geidam",
  //         "Gujba",
  //         "Gulani",
  //         "Jakusko",
  //         "Karasuwa",
  //         "Karawa",
  //         "Machina",
  //         "Nangere",
  //         "Nguru Potiskum",
  //         "Tarmua",
  //         "Yunusari",
  //         "Yusufari"
  //       ],
  //       "Zamfara": [
  //         "Anka",
  //         "Bakura",
  //         "Birnin Magaji",
  //         "Bukkuyum",
  //         "Bungudu",
  //         "Gummi",
  //         "Gusau",
  //         "Kaura",
  //         "Namoda",
  //         "Maradun",
  //         "Maru",
  //         "Shinkafi",
  //         "Talata Mafara",
  //         "Tsafe",
  //         "Zurmi"
  //       ]
  //     }
  //   ]';

  //   $states= json_decode($data,true);
  //   foreach($states[0] as $key=>$value){
  //       ///print($key)."**************<br/>";
  //        //App\Models\State::create(['name'=>$key]);
  //        $state= App\Models\State::where('name',$key)->firstOrFail();
  //     //    print  $state->id;
  //       foreach($states[0][$key] as $st){
  //           //print $st. "<br/><br/>";
  //           App\Models\LocalGovernment::create(['name'=>$st,'state_id'=>  $state->id]);
  //       }

  //   }
  // return  $states[0]['Abia'];

  //return App\Models\State::first()->localgovernments;

  //return view('welcome');
  // $start = 0;
  // $end = 100;


  // $spervisor = \App\Models\SupervisorReport::find(1);
  // $spervisors = \App\Models\SupervisorReport::where('status', '!=', 'Queried')->get();

  // while($start < $end) {
  //   $start++;
  //   $spervisorNew= $spervisor->replicate();
  //   $spervisorNew->save();
  // }


  // foreach($spervisors as $su){
  //   $su->update(['uuid'=>Uuid::uuid4()]);
  // }


  $roads = '
    [{
        "Timestamp": "9/20/2021 16:45:20",
        "Score": "0",
        "Road Name": "Umuahia ikot Ekpene road",
        "Senatorial District": "Abia Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/20/2021 16:48:55",
        "Score": "0",
        "Road Name": "Umuahia ikot Ekpene",
        "Senatorial District": "Abia Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/20/2021 16:52:06",
        "Score": "0",
        "Road Name": "Umuahia ikot Ekpene",
        "Senatorial District": "Abia Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/20/2021 16:55:01",
        "Score": "0",
        "Road Name": "Umuahia ikot Ekpene road",
        "Senatorial District": "Abia Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/19/2021 21:22:48",
        "Score": "0",
        "Road Name": "Aba ikot Ekpene road",
        "Senatorial District": "Abia south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/19/2021 21:29:50",
        "Score": "0",
        "Road Name": "Aba ikot Ekpene road",
        "Senatorial District": "Abia south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/19/2021 21:34:49",
        "Score": "0",
        "Road Name": "ABA ikot Ekpene road",
        "Senatorial District": "Abia south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/19/2021 21:38:06",
        "Score": "0",
        "Road Name": "ABA ikot Ekpene road",
        "Senatorial District": "Abia south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/19/2021 21:42:26",
        "Score": "0",
        "Road Name": "ABA ikot Ekpene road",
        "Senatorial District": "Abia south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/19/2021 21:46:13",
        "Score": "0",
        "Road Name": "ABA ikot Ekpene road",
        "Senatorial District": "Abia south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/20/2021 7:31:32",
        "Score": "0",
        "Road Name": "Aba ikot Ekpene road",
        "Senatorial District": "Abia south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/20/2021 7:42:54",
        "Score": "0",
        "Road Name": "Aba ikot Ekpene road",
        "Senatorial District": "Abia south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/20/2021 7:49:58",
        "Score": "0",
        "Road Name": "Aba ikot Ekpene road",
        "Senatorial District": "Abia south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/20/2021 7:57:41",
        "Score": "0",
        "Road Name": "Aba ikot Ekpene road",
        "Senatorial District": "Abia south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/20/2021 8:05:15",
        "Score": "0",
        "Road Name": "Aba ikot Ekpene road",
        "Senatorial District": "Abia south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/20/2021 8:08:32",
        "Score": "0",
        "Road Name": "Aba ikot Ekpene road",
        "Senatorial District": "Abia south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/29/2021 7:48:00",
        "Score": "0",
        "Road Name": "YANYAN KEFFI ROAD",
        "Senatorial District": "ABUJA",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/29/2021 8:05:38",
        "Score": "0",
        "Road Name": "GWAGWALADA TEACHING HOSPITAL ROAD",
        "Senatorial District": "ABUJA",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/25/2021 7:34:34",
        "Score": "0",
        "Road Name": "GIRI AIRPORT JUNCTION",
        "Senatorial District": "Abuja AMAC",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/25/2021 7:39:17",
        "Score": "0",
        "Road Name": "DEIDEI- DAKWA ROAD",
        "Senatorial District": "Abuja AMAC",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/25/2021 7:44:30",
        "Score": "0",
        "Road Name": "SULEJA-BWARI LAW SCHOOL ROAD",
        "Senatorial District": "Abuja BWARI",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/25/2021 7:49:42",
        "Score": "0",
        "Road Name": "MADALA - SULEJA MAJE JUNCTION ROAD",
        "Senatorial District": "Abuja GWAGWALADA",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/22/2021 10:07:21",
        "Score": "0",
        "Road Name": "ZUBA-ABUJA ROAD",
        "Senatorial District": "ABUJA MUNICIPAL AREA COUNCIL",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/5/2021 10:12:24",
        "Score": "0",
        "Road Name": "Anjawa Jimeta Adamawa Road, Nigeria J96J+FVF 651107 Anjawa Adamawa Nigeria.",
        "Senatorial District": "Adamawa central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/5/2021 10:25:14",
        "Score": "0",
        "Road Name": "Yola sung gombi road j96j+fvf 651107",
        "Senatorial District": "Adamawa central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/5/2021 10:33:17",
        "Score": "0",
        "Road Name": "Gombi garikida biu road (borunu border)",
        "Senatorial District": "Adamawa central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/30/2021 15:30:11",
        "Score": "0",
        "Road Name": "Maiduguri Numan",
        "Senatorial District": "Adamawa Central senatorial zone",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/30/2021 16:05:16",
        "Score": "0",
        "Road Name": "Numan road",
        "Senatorial District": "Adamawa Central senatorial zone",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/30/2021 16:17:53",
        "Score": "0",
        "Road Name": "Abuja road",
        "Senatorial District": "Adamawa Central senatorial zone",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/30/2021 16:28:21",
        "Score": "0",
        "Road Name": "Mararaba shigari fufure",
        "Senatorial District": "Adamawa Central senatorial zone",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/5/2021 10:39:19",
        "Score": "0",
        "Road Name": "Marraba michika madagali road (borunu estate border)",
        "Senatorial District": "Adamawa Northerners",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/30/2021 15:06:38",
        "Score": "0",
        "Road Name": "Ngurore Ganye road",
        "Senatorial District": "Adamawa Southern senatorial zone",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/30/2021 15:20:47",
        "Score": "0",
        "Road Name": "Ganye Adamawa A8, 641113",
        "Senatorial District": "Adamawa Southern senatorial zone",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/30/2021 15:40:23",
        "Score": "0",
        "Road Name": "Ngurore Ganye road",
        "Senatorial District": "Adamawa Southern senatorial zone",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/30/2021 15:45:26",
        "Score": "0",
        "Road Name": "Ganye Adamawa A8, 641113",
        "Senatorial District": "Adamawa Southern senatorial zone",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/30/2021 16:12:59",
        "Score": "0",
        "Road Name": "Maiduguri numan road",
        "Senatorial District": "Adamawa Southern senatorial zone",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 15:34:58",
        "Score": "0",
        "Road Name": "Ete-Abak road starting point",
        "Senatorial District": "Akwa ibom North East",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 17:46:25",
        "Score": "0",
        "Road Name": "Ikot ekpene-umahia- Ariam Road Aks",
        "Senatorial District": "Akwa Ibom north west",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 17:56:32",
        "Score": "0",
        "Road Name": "Ikot-Ekpene-Cal-Itu Road Aks",
        "Senatorial District": "Akwa Ibom north west",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/19/2021 18:21:26",
        "Score": "0",
        "Road Name": "Amawbia/Akwa/Ekwulobia/Okigwe Road,420107",
        "Senatorial District": "Anambra Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 22:18:30",
        "Score": "0",
        "Road Name": "New Oba/Nnewi Road,434116,Oba Nigeria",
        "Senatorial District": "Anambra Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 22:44:53",
        "Score": "0",
        "Road Name": "Nkpor/Awka road/ Nkpor Idemiri north Nkpor,434105",
        "Senatorial District": "Anambra Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/19/2021 18:48:25",
        "Score": "0",
        "Road Name": "Onitsha/ Owerri Road, Dual carriageway,434109",
        "Senatorial District": "Anambra North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 23:04:46",
        "Score": "0",
        "Road Name": "Nsukka/Onitsha, Aguleri road, 385°N",
        "Senatorial District": "Anambra North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/18/2021 0:21:33",
        "Score": "0",
        "Road Name": "Old Oba Nnewi Road,434116",
        "Senatorial District": "Anambra South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/19/2021 18:36:01",
        "Score": "0",
        "Road Name": "Isieke/Ihiala Road, 431119",
        "Senatorial District": "Anambra South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/19/2021 19:00:07",
        "Score": "0",
        "Road Name": "Old Oba/Nnewi Road - Okija with Ozubulu Spur,434116",
        "Senatorial District": "Anambra South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/30/2021 15:21:14",
        "Score": "0",
        "Road Name": "BAUCHI KARI ROAD",
        "Senatorial District": "BAUCHI CENTRAL",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/30/2021 15:37:25",
        "Score": "0",
        "Road Name": "BAUCHI NINGI ROAD",
        "Senatorial District": "BAUCHI CENTRAL",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/27/2021 14:50:15",
        "Score": "0",
        "Road Name": "GOMBE ROAD",
        "Senatorial District": "bauchi central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/30/2021 15:43:28",
        "Score": "0",
        "Road Name": "KARI YANA ROAD",
        "Senatorial District": "BAUCHI NORTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/29/2021 21:19:58",
        "Score": "0",
        "Road Name": "BAUCHI TAFAWA BALEWA ROAD, GOMBE ROAD",
        "Senatorial District": "BAUCHI SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/30/2021 15:04:20",
        "Score": "0",
        "Road Name": "BAUCHI GOMBE ROAD",
        "Senatorial District": "BAUCHI SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/30/2021 15:11:54",
        "Score": "0",
        "Road Name": "BAUCHI TAFAWA BALEWA ROAD",
        "Senatorial District": "BAUCHI SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/9/2021 18:18:08",
        "Score": "0",
        "Road Name": "IDO-TROFANI, DELTA STATE BOARDER ROAD",
        "Senatorial District": "BAYELSA CENTRAL SENATORIAL DISTRICT",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/9/2021 18:27:02",
        "Score": "0",
        "Road Name": "PATANI- KAIAMA- MBIAMA ROAD",
        "Senatorial District": "BAYELSA CENTRAL SENATORIAL DISTRICT",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/9/2021 18:36:26",
        "Score": "0",
        "Road Name": "GBARAIN- NLNG- IGBOGENE- OKOLOBIRI ROAD",
        "Senatorial District": "BAYELSA CENTRAL SENATORIAL DISTRICT",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/11/2021 16:27:02",
        "Score": "0",
        "Road Name": "AIT- BAYELSA-PALM ROAD",
        "Senatorial District": "BAYELSA CENTRAL SENATORIAL DISTRICT",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/30/2021 15:14:09",
        "Score": "0",
        "Road Name": "YENAGOA- IMIRINGI- OLOIBIRI ROAD",
        "Senatorial District": "BAYELSA CENTRAL/EAST SENATORIAL DISTRICT",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/3/2021 13:48:22",
        "Score": "0",
        "Road Name": "Yenagoa-Imiringi-Oloibiri road",
        "Senatorial District": "BAYELSA Central/East senatorial district",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/7/2021 16:00:03",
        "Score": "0",
        "Road Name": "Yenagoa, Oloiberi, Ogbia Road, Bayelsa State",
        "Senatorial District": "Bayelsa East",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/30/2021 15:37:17",
        "Score": "0",
        "Road Name": "ELEBELE-IMIRINGI-ROAD",
        "Senatorial District": "BAYELSA EAST SENATORIAL DISTRIC",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/11/2021 16:42:41",
        "Score": "0",
        "Road Name": "OLOIBIRI- OGBIA ROAD",
        "Senatorial District": "BAYELSA EAST SENATORIAL DISTRICT",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/30/2021 15:25:51",
        "Score": "0",
        "Road Name": "OPOLO- ELEBELE- EMEYAL ROAD",
        "Senatorial District": "BAYELSA EAST SENATORIAL DISTRICT",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/7/2021 15:06:56",
        "Score": "0",
        "Road Name": "Tombia, Yenagoa Amassoma road, Bayelsa state.",
        "Senatorial District": "Bayelsa west",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/25/2021 11:57:17",
        "Score": "0",
        "Road Name": "KATSINA ALA - ZAKI BIAM ROAD",
        "Senatorial District": "BENUE NORTH EAST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/25/2021 13:08:18",
        "Score": "0",
        "Road Name": "KATSINA ALA - VANDEIKYA",
        "Senatorial District": "BENUE NORTH EAST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/7/2021 19:07:22",
        "Score": "0",
        "Road Name": "YANDEV - BURUKU ROAD",
        "Senatorial District": "BENUE NORTH WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/8/2021 8:26:59",
        "Score": "0",
        "Road Name": "GBOKO - ALIADE/OTUKPO ROAD.",
        "Senatorial District": "BENUE NORTH WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/8/2021 8:33:25",
        "Score": "0",
        "Road Name": "OTUKPO - IKACHE ROAD",
        "Senatorial District": "BENUE NORTH WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/8/2021 8:38:15",
        "Score": "0",
        "Road Name": "ANKPA - OTUKPO ROAD",
        "Senatorial District": "BENUE NORTH WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/18/2021 16:15:44",
        "Score": "0",
        "Road Name": "Maiduguri-Damboa",
        "Senatorial District": "Borno central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/19/2021 6:34:05",
        "Score": "0",
        "Road Name": "Maiduguri-Damaturu",
        "Senatorial District": "Borno Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/19/2021 6:37:38",
        "Score": "0",
        "Road Name": "Maiduguri-Bama",
        "Senatorial District": "Borno Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/19/2021 6:41:54",
        "Score": "0",
        "Road Name": "Biu-Damboa",
        "Senatorial District": "Borno South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/19/2021 6:45:26",
        "Score": "0",
        "Road Name": "Biu-Damaturu",
        "Senatorial District": "Borno South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/19/2021 6:48:36",
        "Score": "0",
        "Road Name": "Biu-Shafa/Garkida",
        "Senatorial District": "Borno South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/11/2021 11:04:13",
        "Score": "0",
        "Road Name": "Ikom-Abanliko Road, Cross River State",
        "Senatorial District": "Cross River Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/25/2021 14:51:07",
        "Score": "0",
        "Road Name": "Ikot Okpora- Orira Road, Akamkpa LGA, Cross River State.",
        "Senatorial District": "Cross River Southern Senatorial District",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/11/2021 20:04:20",
        "Score": "0",
        "Road Name": "Ikot Okpora - Orira Road, Akamkpa LGA, Cross River State.",
        "Senatorial District": "Cross River Southern Senatorial District.",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/11/2021 20:13:55",
        "Score": "0",
        "Road Name": "Oriminimba Road, Iwuru, Biase LGA, Cross River State.",
        "Senatorial District": "Cross River Southern Senatorial District.",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/11/2021 20:26:37",
        "Score": "0",
        "Road Name": "Calabar - Oban - Ekang Road, Akpabuyo LGA, Cross River State.",
        "Senatorial District": "Cross River Southern Senatorial District.",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/12/2021 9:50:24",
        "Score": "0",
        "Road Name": "ATIMBO - AKPABUYO ROAD, CALABAR MUNICIPAL LGA, Cross River State.",
        "Senatorial District": "Cross River Southern Senatorial District.",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/28/2021 9:21:52",
        "Score": "0",
        "Road Name": "Benin - Sapele Road 300105 to Warri Port Expy, Tori 330102",
        "Senatorial District": "Delta Central 1",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/28/2021 9:35:08",
        "Score": "0",
        "Road Name": "Warri - Port (NPA), to Warri Port Expy, Aladja 330103",
        "Senatorial District": "Delta Central 2",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/3/2021 15:37:15",
        "Score": "0",
        "Road Name": "Opolo-Elebele-Emeyal Road",
        "Senatorial District": "DELTA EAST Senatorial District",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/22/2021 8:10:30",
        "Score": "0",
        "Road Name": "Asaba Delta, off Anwai, Illah Road, GRA Phase 1 320242 to Ora Delta, Ilukwu Illah",
        "Senatorial District": "Delta North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/22/2021 8:24:44",
        "Score": "0",
        "Road Name": "Ogwashi Ukwu Junction, Asaba-Agbor Hwy to Null, Benin-Agbor Hwy, Nigeria",
        "Senatorial District": "Delta North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/4/2021 16:45:52",
        "Score": "0",
        "Road Name": "PATANI- KAIMA- MBIAMA ROAD",
        "Senatorial District": "DELTA SENATORIAL DISTRICT",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/4/2021 16:55:39",
        "Score": "0",
        "Road Name": "ODI- TROFANI, DELTA STATE BOARDER",
        "Senatorial District": "DELTA SENATORIAL DISTRICT",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/28/2021 9:11:30",
        "Score": "0",
        "Road Name": "Oleh - Okpari - Warri Road 334109",
        "Senatorial District": "Delta South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/24/2021 14:19:43",
        "Score": "0",
        "Road Name": "ABAKALIKI -AFIKPO ROAD",
        "Senatorial District": "Ebonyi ABAKALIKI NORTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/27/2021 21:43:02",
        "Score": "0",
        "Road Name": "Abakaliki Ogoja Federal Road Ebonyi state.",
        "Senatorial District": "Ebonyi central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/27/2021 21:53:39",
        "Score": "0",
        "Road Name": "Abakaliki-Oferekpe Federal Road",
        "Senatorial District": "Ebonyi Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/27/2021 9:00:16",
        "Score": "0",
        "Road Name": "Abakaliki - Ediba/Ugep Road, Yakurr LGA, Cross River State.",
        "Senatorial District": "Ebonyi Central Senatorial District",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/28/2021 14:16:11",
        "Score": "0",
        "Road Name": "Ikom - Abanliku",
        "Senatorial District": "Ebonyi Central Senatorial District",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/11/2021 19:49:26",
        "Score": "0",
        "Road Name": "Abakaliki - Ugep Road, Yakkur LGA, Cross River State.",
        "Senatorial District": "Ebonyi Central Senatorial District",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/27/2021 22:00:45",
        "Score": "0",
        "Road Name": "Abakaliki-Afikpo Road",
        "Senatorial District": "Ebonyi North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/28/2021 1:54:36",
        "Score": "0",
        "Road Name": "Abakaliki-Enugu Road",
        "Senatorial District": "Ebonyi North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/24/2021 15:05:41",
        "Score": "0",
        "Road Name": "Obiozara-mpu-ishiagu portharcout junction federal road",
        "Senatorial District": "EBONYI SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/27/2021 22:08:20",
        "Score": "0",
        "Road Name": "Uwana-Erer Road",
        "Senatorial District": "Ebonyi south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/28/2021 1:47:41",
        "Score": "0",
        "Road Name": "Obiozara-Uburu-Mpu-Ishiagu",
        "Senatorial District": "Ebonyi south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/24/2021 14:32:01",
        "Score": "0",
        "Road Name": "AFIKPO -OKIGWE ROAD",
        "Senatorial District": "EBONYI SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/28/2021 1:22:35",
        "Score": "0",
        "Road Name": "Is so-Edda-Owutu-Nguzu -Ohofia Road",
        "Senatorial District": "Ebonyi south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/28/2021 1:29:48",
        "Score": "0",
        "Road Name": "Owutu -Amasiri-Okposi Uburu Road",
        "Senatorial District": "Ebonyi south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/28/2021 1:40:23",
        "Score": "0",
        "Road Name": "Ubagu-Avuzo-Ogwor Federal Road",
        "Senatorial District": "Ebonyi south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/22/2021 21:22:29",
        "Score": "0",
        "Road Name": "Benin-sapele high way",
        "Senatorial District": "Edo South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/22/2021 21:30:02",
        "Score": "0",
        "Road Name": "Benin-Agbor high way",
        "Senatorial District": "Edo South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/22/2021 21:36:42",
        "Score": "0",
        "Road Name": "Benin-Shagamu high way",
        "Senatorial District": "Edo South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/23/2021 10:19:53",
        "Score": "0",
        "Road Name": "Benin bypass",
        "Senatorial District": "Edo South senatorial destrict",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/17/2021 7:53:11",
        "Score": "0",
        "Road Name": "Aramoko - Ijero Ekiti road",
        "Senatorial District": "Ekiti Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/17/2021 7:59:17",
        "Score": "0",
        "Road Name": "Ido - Ijero Ekiti road (Ijero Ekiti)",
        "Senatorial District": "Ekiti Central / North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/17/2021 7:42:52",
        "Score": "0",
        "Road Name": "Ikole - Omuo road (Ayebode Ekiti)",
        "Senatorial District": "Ekiti North/South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/17/2021 7:35:53",
        "Score": "0",
        "Road Name": "Omuo - Ifeolukotun Road (Ifeolukotun)",
        "Senatorial District": "Ekiti South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/22/2021 14:50:52",
        "Score": "0",
        "Road Name": "Ado-Iyin-Igede-Aramoko-Itawure road",
        "Senatorial District": "Ekiti South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/14/2021 8:02:30",
        "Score": "0",
        "Road Name": "ENUGU-ABAKALIKI ROAD, ENUGU, NIGERIA.",
        "Senatorial District": "ENUGU EAST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/25/2021 16:23:05",
        "Score": "0",
        "Road Name": "ENUGU-ONITSHA (DUAL) EXPRESSWAY ANAMBRA STATE BORDER ROAD IN ENUGU STATE",
        "Senatorial District": "Enugu East",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/15/2021 15:24:30",
        "Score": "0",
        "Road Name": "NSUKKA - ADANI ROAD, ENUGU NIGERIA",
        "Senatorial District": "ENUGU NORTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/15/2021 15:31:35",
        "Score": "0",
        "Road Name": "NSUKKA - ODOLU ROAD, ENUGU NIGERIA",
        "Senatorial District": "ENUGU NORTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/25/2021 16:35:11",
        "Score": "0",
        "Road Name": "9TH MILE-OPI-NSUKKA (OLD ROAD) IN ENUGU STATE",
        "Senatorial District": "ENUGU NORTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/25/2021 16:51:45",
        "Score": "0",
        "Road Name": "9TH MILE-OBOLLO AFOR-OTUKPA BENUE STATE BORDER ROAD IN ENUGU STATE",
        "Senatorial District": "Enugu North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/25/2021 17:06:31",
        "Score": "0",
        "Road Name": "ADANI-OGURUGU KOGI STATE BORDER ROAD IN ENUGU STATE",
        "Senatorial District": "ENUGU NORTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/14/2021 7:46:42",
        "Score": "0",
        "Road Name": "ENUGU - PORTHARCOURT RD, AGWU, (0LD ROAD)",
        "Senatorial District": "ENUGU WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/14/2021 7:55:20",
        "Score": "0",
        "Road Name": "UDI-OZALLA-NARA- NKEREFI ROAD, ENUGU, NIGERIA.",
        "Senatorial District": "ENUGU WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/25/2021 16:12:31",
        "Score": "0",
        "Road Name": "9TH MILE-OJI RIVER (OLD ROAD) ANAMBRA STATE BORDER ROAD IN ENUGU STATE",
        "Senatorial District": "ENUGU WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/24/2021 16:06:26",
        "Score": "0",
        "Road Name": "ENUGU-PORTHARCOURT (DUAL) EXPRESS ROAD, ENUGU NIGERIA",
        "Senatorial District": "ENUGU-WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/24/2021 20:18:47",
        "Score": "0",
        "Road Name": "9TH MILE-ENUGU (NEW MARKET)",
        "Senatorial District": "ENUGU-WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/24/2021 20:27:48",
        "Score": "0",
        "Road Name": "ENUGU-PORTHARCOURT (DUAL) EXPRESS WAY, ENUGU",
        "Senatorial District": "ENUGU-WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/29/2021 17:06:34",
        "Score": "0",
        "Road Name": "GOMBE BIU ROAD",
        "Senatorial District": "GOMBE CENTRAL",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/29/2021 17:19:49",
        "Score": "0",
        "Road Name": "GOMBE BAUCHI ROAD",
        "Senatorial District": "GOMBE CENTRAL",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/29/2021 17:24:11",
        "Score": "0",
        "Road Name": "AKKO BYE PASS",
        "Senatorial District": "GOMBE CENTRAL",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/29/2021 15:31:33",
        "Score": "0",
        "Road Name": "GOMBE POTISKUM ROAD",
        "Senatorial District": "GOMBE NORTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/29/2021 17:30:44",
        "Score": "0",
        "Road Name": "GOMBE DUKKU BYEPASS",
        "Senatorial District": "GOMBE NORTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/22/2021 20:25:55",
        "Score": "0",
        "Road Name": "Gombe Dukku Road in Gombe State",
        "Senatorial District": "Gombe North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/22/2021 21:52:49",
        "Score": "0",
        "Road Name": "GOMBE DUKKU ROAD",
        "Senatorial District": "GOMBE NORTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/6/2021 12:25:52",
        "Score": "0",
        "Road Name": "Damaturu to gashu,a",
        "Senatorial District": "Gombe North east",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/6/2021 12:49:34",
        "Score": "0",
        "Road Name": "Gashu,a baiomari",
        "Senatorial District": "Gombe North east",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/29/2021 15:59:19",
        "Score": "0",
        "Road Name": "GOMBE NUMAN ROAD",
        "Senatorial District": "GOMBE SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/29/2021 17:15:33",
        "Score": "0",
        "Road Name": "BILLIRI FILIYA ROAD",
        "Senatorial District": "GOMBE SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/6/2021 7:35:07",
        "Score": "0",
        "Road Name": "Damaturu biu road",
        "Senatorial District": "Gombe Zone a",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/11/2021 11:53:09",
        "Score": "0",
        "Road Name": "Aba-Owerri exp",
        "Senatorial District": "IMO north",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/12/2021 14:12:24",
        "Score": "0",
        "Road Name": "Owerri-okigwe road",
        "Senatorial District": "Imo Okigwe north",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/12/2021 14:15:22",
        "Score": "0",
        "Road Name": "Okwelle",
        "Senatorial District": "Imo Okigwe North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/16/2021 5:42:18",
        "Score": "0",
        "Road Name": "Amanze-mile 7 1/2- umuelemai-umuna rd",
        "Senatorial District": "Imo Okigwe Zone",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/16/2021 5:01:40",
        "Score": "0",
        "Road Name": "Enugu-port harcourt express road",
        "Senatorial District": "Imo Okigwe zone",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/16/2021 5:06:43",
        "Score": "0",
        "Road Name": "Okigwe arondizuogu- uga road",
        "Senatorial District": "Imo Okigwe/orlu zone",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/16/2021 5:15:05",
        "Score": "0",
        "Road Name": "Owerri orlu road",
        "Senatorial District": "Imo Orlu zone",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/16/2021 5:10:42",
        "Score": "0",
        "Road Name": "Orlu-Akokwa-uga road",
        "Senatorial District": "Imo Orlu zone",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/16/2021 5:45:53",
        "Score": "0",
        "Road Name": "Ihiala orlu- umu duru road",
        "Senatorial District": "Imo Orlu/Okigwe zone",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/24/2021 7:49:16",
        "Score": "0",
        "Road Name": "Onitsha owerri road",
        "Senatorial District": "Imo Owerri minicipal",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/11/2021 12:10:45",
        "Score": "0",
        "Road Name": "Onitsha- Owerri road",
        "Senatorial District": "Imo Owerri west",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/16/2021 5:33:51",
        "Score": "0",
        "Road Name": "Okpala- igrita rd",
        "Senatorial District": "Imo Owerri zone",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/16/2021 5:36:55",
        "Score": "0",
        "Road Name": "Afor enyiogugu road",
        "Senatorial District": "Imo Owerri zone",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/16/2021 5:18:44",
        "Score": "0",
        "Road Name": "Owerri-umuaka rd",
        "Senatorial District": "Imo Owerri zone",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/16/2021 5:30:16",
        "Score": "0",
        "Road Name": "Owerri-obowo- umuahia rd",
        "Senatorial District": "Imo Owerri-Okigwe zone",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/16/2021 5:23:57",
        "Score": "0",
        "Road Name": "Owerri port harcourt rd",
        "Senatorial District": "Imo Owerri/orlu zone",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/23/2021 22:20:40",
        "Score": "0",
        "Road Name": "Birnin kudu kano bauchi raod",
        "Senatorial District": "Jigawa central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/23/2021 22:36:40",
        "Score": "0",
        "Road Name": "Ningi bauchi raod",
        "Senatorial District": "Jigawa central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/23/2021 23:41:28",
        "Score": "0",
        "Road Name": "Hadejia nguru raod",
        "Senatorial District": "Jigawa North east",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/24/2021 0:07:23",
        "Score": "0",
        "Road Name": "Kaffin hausa raod",
        "Senatorial District": "Jigawa North east",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/24/2021 0:24:26",
        "Score": "0",
        "Road Name": "Hadejia gamayin raod",
        "Senatorial District": "Jigawa North east",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/23/2021 23:04:07",
        "Score": "0",
        "Road Name": "Kano gumel hadejia raod",
        "Senatorial District": "Jigawa North west",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/23/2021 23:21:01",
        "Score": "0",
        "Road Name": "Gumel maigatari niger raod",
        "Senatorial District": "Jigawa North west",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/16/2021 23:36:36",
        "Score": "0",
        "Road Name": "Sabo ungwan Sunday road",
        "Senatorial District": "Kaduna central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/18/2021 23:41:00",
        "Score": "0",
        "Road Name": "Mando-Birnin Gwari road mapping",
        "Senatorial District": "Kaduna central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/16/2021 23:59:30",
        "Score": "0",
        "Road Name": "Kaduna Zaria jos road",
        "Senatorial District": "Kaduna north",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/17/2021 0:22:11",
        "Score": "0",
        "Road Name": "Zaria-Sokoto Road",
        "Senatorial District": "Kaduna north",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/18/2021 23:11:24",
        "Score": "0",
        "Road Name": "Kaduna -abuja express way road mapping",
        "Senatorial District": "Kaduna south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/22/2021 13:40:25",
        "Score": "0",
        "Road Name": "Anguwa boro -kachia road",
        "Senatorial District": "Kaduna south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/5/2021 14:36:48",
        "Score": "0",
        "Road Name": "Kano-kano,Ring Road Bypass",
        "Senatorial District": "KANO Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/4/2021 11:16:11",
        "Score": "0",
        "Road Name": "Kwanar-Dumawa-Kunya Road",
        "Senatorial District": "KANO central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/4/2021 11:36:12",
        "Score": "0",
        "Road Name": "Kunya-mujibir- Gezawa Road",
        "Senatorial District": "KANO central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/4/2021 11:55:14",
        "Score": "0",
        "Road Name": "Albasu -kano, Jigawa state Border",
        "Senatorial District": "KANO central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/4/2021 12:24:23",
        "Score": "0",
        "Road Name": "KANO western bypass,",
        "Senatorial District": "KANO central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/5/2021 13:58:52",
        "Score": "0",
        "Road Name": "Bichi-Badume Road kano",
        "Senatorial District": "KANO North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/5/2021 14:11:31",
        "Score": "0",
        "Road Name": "Kabo-kano road",
        "Senatorial District": "KANO North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/4/2021 10:41:36",
        "Score": "0",
        "Road Name": "Labam-kunchi kazaure, Jigawa KANO Border Road",
        "Senatorial District": "KANO North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/4/2021 12:15:02",
        "Score": "0",
        "Road Name": "Kastina-Gwarzo Road",
        "Senatorial District": "KANO North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/5/2021 13:44:56",
        "Score": "0",
        "Road Name": "Kano-Danbata Road, kano-Daura Border Road,",
        "Senatorial District": "KANO North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/5/2021 14:25:21",
        "Score": "0",
        "Road Name": "Gaya-kano,Wudil-Gaya Road",
        "Senatorial District": "KANO South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/4/2021 10:24:42",
        "Score": "0",
        "Road Name": "KANO-Jigawa-Birni kudi Border Road",
        "Senatorial District": "KANO South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/4/2021 12:32:48",
        "Score": "0",
        "Road Name": "Bagauda-Tiga- Bebeji Rahima road",
        "Senatorial District": "KANO south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "12/11/2021 11:29:28",
        "Score": "0",
        "Road Name": "KATSINA - DUTSINMA - KANKARA - KURFI ROAD.",
        "Senatorial District": "KATSINA Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "12/11/2021 11:05:58",
        "Score": "0",
        "Road Name": "DUTSINMA - KANKIA ROAD.",
        "Senatorial District": "KATSINA Central.",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "12/11/2021 11:55:10",
        "Score": "0",
        "Road Name": "KATSINA - JIBIYA - NIGER REPUBLIC BORDER.",
        "Senatorial District": "KATSINA Central.",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "12/10/2021 0:13:37",
        "Score": "0",
        "Road Name": "(Jigawa state border) Kazaure Daura Kongolam Niger Republic border road.",
        "Senatorial District": "KATSINA North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "12/11/2021 10:56:13",
        "Score": "0",
        "Road Name": "KATSINA - DAURA - ZANGO ROAD",
        "Senatorial District": "KATSINA North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "12/11/2021 13:10:37",
        "Score": "0",
        "Road Name": "FUNTUA - GUSAU (ZAMFARA STATE BORDER) ROAD.",
        "Senatorial District": "KATSINA South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "12/11/2021 12:35:20",
        "Score": "0",
        "Road Name": "FUNTUA - ZARIA KADUNA STATE BORDER.",
        "Senatorial District": "KATSINA South.",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/28/2021 17:54:00",
        "Score": "0",
        "Road Name": "Kalgo Road Kebbi State",
        "Senatorial District": "Kebbi central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/28/2021 20:44:14",
        "Score": "0",
        "Road Name": "Kalgo Road Kebbi State",
        "Senatorial District": "Kebbi central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/28/2021 20:56:35",
        "Score": "0",
        "Road Name": "Bunza Kebbi State",
        "Senatorial District": "Kebbi central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/28/2021 21:04:42",
        "Score": "0",
        "Road Name": "Bunza Kebbi State",
        "Senatorial District": "Kebbi central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/28/2021 17:47:55",
        "Score": "0",
        "Road Name": "Kalgo Road Kebbi State",
        "Senatorial District": "Kebbi central senatorial District",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/25/2021 18:03:05",
        "Score": "0",
        "Road Name": "Kebbi North",
        "Senatorial District": "Kebbi North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/25/2021 19:45:15",
        "Score": "0",
        "Road Name": "Kebbi North",
        "Senatorial District": "Kebbi North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/25/2021 21:01:03",
        "Score": "0",
        "Road Name": "Kebbi North",
        "Senatorial District": "Kebbi North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/27/2021 14:40:50",
        "Score": "0",
        "Road Name": "Birnin Kebbi to argungu to sokoto boarder",
        "Senatorial District": "Kebbi North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/27/2021 14:46:09",
        "Score": "0",
        "Road Name": "Birnin Kebbi to argungu to sokoto boarder",
        "Senatorial District": "Kebbi North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/28/2021 18:22:33",
        "Score": "0",
        "Road Name": "Bagudo Road Kebbi State",
        "Senatorial District": "Kebbi North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/28/2021 18:39:18",
        "Score": "0",
        "Road Name": "Bagudo Road Kebbi State",
        "Senatorial District": "Kebbi North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 22:49:50",
        "Score": "0",
        "Road Name": "Okene Ajaokuta Road",
        "Senatorial District": "Kogi Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 22:57:04",
        "Score": "0",
        "Road Name": "Okene-Auchi Road",
        "Senatorial District": "Kogi Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/23/2021 10:05:59",
        "Score": "0",
        "Road Name": "Lokoja - Abuja Road",
        "Senatorial District": "Kogi Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 22:22:22",
        "Score": "0",
        "Road Name": "Chukwu Merege Roundabout Asco Bumbs Poner Plant Ajaokuta-Anyangba Road",
        "Senatorial District": "Kogi East",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 22:28:51",
        "Score": "0",
        "Road Name": "Ayangba-Itobe Road",
        "Senatorial District": "Kogi East",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 22:36:10",
        "Score": "0",
        "Road Name": "Idah Odolu Road",
        "Senatorial District": "Kogi East",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/20/2021 21:56:24",
        "Score": "0",
        "Road Name": "Okene Kabba Road",
        "Senatorial District": "Kogi West",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/20/2021 22:05:00",
        "Score": "0",
        "Road Name": "Kabba Ijumu Road",
        "Senatorial District": "Kogi West",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/20/2021 22:18:35",
        "Score": "0",
        "Road Name": "Kabba Mopa Isanlu Egbe Road",
        "Senatorial District": "Kogi West",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 22:06:06",
        "Score": "0",
        "Road Name": "Kabba-Ayere Road",
        "Senatorial District": "Kogi West",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/17/2021 9:19:14",
        "Score": "0",
        "Road Name": "Ogbomosho-ote-Gambari road",
        "Senatorial District": "Kwara Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/4/2021 13:30:36",
        "Score": "0",
        "Road Name": "Iporin-Share road",
        "Senatorial District": "Kwara Ilorin East.",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/4/2021 13:37:48",
        "Score": "0",
        "Road Name": "Iporin-oke oyi",
        "Senatorial District": "Kwara Ilorin East.",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/4/2021 13:42:49",
        "Score": "0",
        "Road Name": "\"Lafiaji_share ",
        "Senatorial District": null,
        "null": null,
        "": null
    },
    {
        "Timestamp": " Share gbudu gbudu\"",
        "Score": "Kwara Ilorin East.",
        "Road Name": "Vegetation Control, Other Direct Labour Work",
        "Senatorial District": "8.838171",
        "null": null,
        "": null
    },
    {
        "Timestamp": "11/4/2021 13:49:50",
        "Score": "0",
        "Road Name": "Shobi road",
        "Senatorial District": "Kwara Ilorin East.",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/28/2021 13:51:08",
        "Score": "0",
        "Road Name": "Omu Aran irepodun road",
        "Senatorial District": "Kwara Ilorin South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/28/2021 15:16:40",
        "Score": "0",
        "Road Name": "Ekan meje",
        "Senatorial District": "Kwara Ilorin South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/27/2021 10:28:15",
        "Score": "0",
        "Road Name": "Ilorin-Igbeti road",
        "Senatorial District": "Kwara Ilorin west",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/28/2021 13:24:42",
        "Score": "0",
        "Road Name": "Kaima road",
        "Senatorial District": "Kwara Ilorin west",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/27/2021 11:09:31",
        "Score": "0",
        "Road Name": "\"Baruten",
        "Senatorial District": null,
        "null": null,
        "": null
    },
    {
        "Timestamp": " Ilesha bariba road\"",
        "Score": "Kwara north central",
        "Road Name": "Vegetation Control, Road Clearing, Other Direct Labour Work",
        "Senatorial District": "8.88323",
        "null": null,
        "": null
    },
    {
        "Timestamp": "10/28/2021 14:45:07",
        "Score": "0",
        "Road Name": "Ajase IPO road",
        "Senatorial District": "Kwara South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/28/2021 15:02:28",
        "Score": "0",
        "Road Name": "Erin ile",
        "Senatorial District": "Kwara South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "12/18/2021 17:37:00",
        "Score": "0",
        "Road Name": "Lafia, Jos Road",
        "Senatorial District": "Lafia North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/16/2021 19:34:00",
        "Score": "0",
        "Road Name": "Ikorodu road",
        "Senatorial District": "Lagos east",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/16/2021 21:35:40",
        "Score": "0",
        "Road Name": "Amure to imota road",
        "Senatorial District": "Lagos east",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/17/2021 10:39:19",
        "Score": "0",
        "Road Name": "Awa-itoikin road",
        "Senatorial District": "Lagos east",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/17/2021 10:51:05",
        "Score": "0",
        "Road Name": "Ikorodu-epe road",
        "Senatorial District": "Lagos east",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/17/2021 11:23:38",
        "Score": "0",
        "Road Name": "Ikorodu-epe road",
        "Senatorial District": "Lagos east",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/20/2021 17:18:23",
        "Score": "0",
        "Road Name": "Agege/Pencinema Lagos Road",
        "Senatorial District": "Lagos East",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 15:47:41",
        "Score": "0",
        "Road Name": "Lagos island",
        "Senatorial District": "Lagos east",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 15:58:48",
        "Score": "0",
        "Road Name": "Awolowo road lagos island",
        "Senatorial District": "Lagos east",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 16:10:20",
        "Score": "0",
        "Road Name": "Force road lagos island",
        "Senatorial District": "Lagos east",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/27/2021 4:12:58",
        "Score": "0",
        "Road Name": "Ikorodu/epe road",
        "Senatorial District": "Lagos east",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/20/2021 16:58:16",
        "Score": "0",
        "Road Name": "IJORA OLOPA PALACE ROAD",
        "Senatorial District": "LAGOS WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/20/2021 17:28:48",
        "Score": "0",
        "Road Name": "BOUNDARY/BALEE OLODI APAPA KIRIKIRI ROAD",
        "Senatorial District": "LAGOS WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 12:18:30",
        "Score": "0",
        "Road Name": "LAGOS BADAGRY/ SEME BOADER ROAD",
        "Senatorial District": "LAGOS WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/16/2021 15:50:41",
        "Score": "0",
        "Road Name": "Lagos/Abeokuta dual carriage way",
        "Senatorial District": "Lagos West",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/28/2021 15:06:24",
        "Score": "0",
        "Road Name": "Kebbi Sokoto Expressway",
        "Senatorial District": "Nasarawa Keffi Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "12/18/2021 18:38:42",
        "Score": "0",
        "Road Name": "NASARAWA EGGON ROAD",
        "Senatorial District": "NASARAWA NORTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "12/22/2021 11:17:11",
        "Score": "0",
        "Road Name": "WAMBA ROAD",
        "Senatorial District": "NASARAWA NORTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "12/24/2021 12:56:47",
        "Score": "0",
        "Road Name": "AKWANGA ROAD",
        "Senatorial District": "NASARAWA NORTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "1/26/2022 13:24:24",
        "Score": "0",
        "Road Name": "GIDAN MAI AKWIYA",
        "Senatorial District": "NASARAWA SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "1/26/2022 14:46:32",
        "Score": "0",
        "Road Name": "DOMA ROAD",
        "Senatorial District": "NASARAWA SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "1/26/2022 8:39:50",
        "Score": "0",
        "Road Name": "SHANDAM ROAD LAFIA",
        "Senatorial District": "NASARAWA SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "1/26/2022 14:03:40",
        "Score": "0",
        "Road Name": "ASHINGE",
        "Senatorial District": "NASARAWA SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "1/26/2022 14:18:01",
        "Score": "0",
        "Road Name": "ASSAIKIO",
        "Senatorial District": "NASARAWA SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "1/26/2022 14:25:00",
        "Score": "0",
        "Road Name": "UNGWAN MAI SAMARI",
        "Senatorial District": "NASARAWA SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "1/26/2022 14:36:18",
        "Score": "0",
        "Road Name": "DOMA",
        "Senatorial District": "NASARAWA SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "1/26/2022 14:53:11",
        "Score": "0",
        "Road Name": "DOMA RAOD",
        "Senatorial District": "NASARAWA SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "1/26/2022 15:43:57",
        "Score": "0",
        "Road Name": "DOMA",
        "Senatorial District": "NASARAWA SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "1/29/2022 18:02:50",
        "Score": "0",
        "Road Name": "MAKURDI ROAD",
        "Senatorial District": "NASARAWA SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "1/29/2022 18:09:11",
        "Score": "0",
        "Road Name": "GANDU",
        "Senatorial District": "NASARAWA SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "1/29/2022 18:57:00",
        "Score": "0",
        "Road Name": "AWE ROAD, AGWATASHI",
        "Senatorial District": "NASARAWA SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "1/29/2022 19:28:25",
        "Score": "0",
        "Road Name": "AWE",
        "Senatorial District": "NASARAWA SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "1/29/2022 19:40:32",
        "Score": "0",
        "Road Name": "AWE ROAD",
        "Senatorial District": "NASARAWA SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "12/24/2021 18:14:35",
        "Score": "0",
        "Road Name": "KEFFI ROAD",
        "Senatorial District": "NASARAWA WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "12/24/2021 19:14:57",
        "Score": "0",
        "Road Name": "GITATA ROAD",
        "Senatorial District": "NASARAWA WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "12/24/2021 23:29:52",
        "Score": "0",
        "Road Name": "LAMIGA ROAD",
        "Senatorial District": "NASARAWA WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "12/24/2021 23:39:51",
        "Score": "0",
        "Road Name": "NASARAWA ROAD",
        "Senatorial District": "NASARAWA WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/22/2021 22:23:25",
        "Score": "0",
        "Road Name": "ZUNGERU _TEGINA ROAD",
        "Senatorial District": "NIGER NORTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 21:59:19",
        "Score": "0",
        "Road Name": "Bida, lemu road to Zungeru",
        "Senatorial District": "NIGER NORTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "12/11/2021 13:45:17",
        "Score": "0",
        "Road Name": "FUNTUA - MALUMFASHI-YASHE ROAD.",
        "Senatorial District": "NIGER NORTH /CENTRAL",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/2/2021 12:23:06",
        "Score": "0",
        "Road Name": "Ibeto, Salka, Auna and New Warra Kebbi State border",
        "Senatorial District": "Niger North Central District",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/17/2021 11:44:52",
        "Score": "0",
        "Road Name": "1-Kontagora to Tegina road, Niger, Nigeria start point",
        "Senatorial District": "Niger North Senatorial District",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/2/2021 11:53:11",
        "Score": "0",
        "Road Name": "Kontagora, Rijau Kebbi\'s State Border",
        "Senatorial District": "Niger north senatorial district",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/7/2021 10:10:53",
        "Score": "0",
        "Road Name": "Auna to New Bussa",
        "Senatorial District": "Niger North Senatorial District",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/7/2021 10:25:00",
        "Score": "0",
        "Road Name": "Mokwa to Kainji",
        "Senatorial District": "Niger North Senatorial District",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/2/2021 12:04:44",
        "Score": "0",
        "Road Name": "Kontagora, Ibeto Kebbi\'s State border",
        "Senatorial District": "Niger Senatorial District",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/6/2021 20:35:04",
        "Score": "0",
        "Road Name": "Bida, Sacci, Nupeko",
        "Senatorial District": "Niger South Senatorial District",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/7/2021 12:22:24",
        "Score": "0",
        "Road Name": "Mokwa junction Bida",
        "Senatorial District": "Niger South Senatorial District",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/7/2021 12:35:02",
        "Score": "0",
        "Road Name": "Kainji Dam, New Bussa to Wawa",
        "Senatorial District": "Niger South Senatorial District",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/30/2021 23:03:47",
        "Score": "0",
        "Road Name": "ABEOKUTA Rounder-Imeko-Afon road",
        "Senatorial District": "Ogun Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/30/2021 23:25:18",
        "Score": "0",
        "Road Name": "ABEOKUTA ITA OSHIN-IBARA-ORILE-ISAGA-ILARO ROAD",
        "Senatorial District": "Ogun Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/16/2021 13:46:36",
        "Score": "0",
        "Road Name": "ABEOKUTA/ITA OSHIN-IBARA-ORILE-ISAGA-ILARO ROAD",
        "Senatorial District": "OGUN CENTRAL",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/26/2021 20:59:31",
        "Score": "0",
        "Road Name": "ÀBEOKUTA-SHAGAMU INTERCHANGE DUALCARRIAGE WAY",
        "Senatorial District": "OGUN CENTRAL",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/31/2021 1:28:39",
        "Score": "0",
        "Road Name": "ABEOKUTA-Bakatari Road (Oyo state Border)",
        "Senatorial District": "Ogun Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/30/2021 22:18:11",
        "Score": "0",
        "Road Name": "(Start Point)Itokin-Ijebu-Ode-Awa-Ibadan boundary rd.",
        "Senatorial District": "Ogun East",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/30/2021 23:58:34",
        "Score": "0",
        "Road Name": "Ishara-Ago Iwoye-Ijebu-Igbo road",
        "Senatorial District": "Ogun East",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/30/2021 23:40:17",
        "Score": "0",
        "Road Name": "Ijebu-Igbo-Ogedengbe-Ife Sekona Road Mapping",
        "Senatorial District": "Ogun East",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/30/2021 22:43:00",
        "Score": "0",
        "Road Name": "Ishara-Ago Iwoye-Ijebu Igbo road",
        "Senatorial District": "Ogun East",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/30/2021 23:09:54",
        "Score": "0",
        "Road Name": "J4-Oso-Iwopin Road",
        "Senatorial District": "Ogun East",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/30/2021 23:49:25",
        "Score": "0",
        "Road Name": "Sango/Otta-Owode Yewa-Idiroko rd",
        "Senatorial District": "Ogun West",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/31/2021 0:08:36",
        "Score": "0",
        "Road Name": "Papalanto -Ilaro Road Mapping",
        "Senatorial District": "Ogun West",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/31/2021 0:43:58",
        "Score": "0",
        "Road Name": "Atan -Agbara Rd mapping (Lagos state Border)",
        "Senatorial District": "Ogun West",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/23/2021 18:39:16",
        "Score": "0",
        "Road Name": "Akure Owo Road",
        "Senatorial District": "Ondo Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/23/2021 18:58:18",
        "Score": "0",
        "Road Name": "Owo Sobe Road",
        "Senatorial District": "Ondo Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/25/2021 20:55:35",
        "Score": "0",
        "Road Name": "Ondo Akure Road",
        "Senatorial District": "Ondo Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/6/2021 20:37:39",
        "Score": "0",
        "Road Name": "Akure - Ilesha Road",
        "Senatorial District": "Ondo Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/10/2021 16:11:24",
        "Score": "0",
        "Road Name": "Ifon Uzeba - Ose River Bridge (Rdo State Border) Rosd",
        "Senatorial District": "Ondo Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/10/2021 16:24:14",
        "Score": "0",
        "Road Name": "Ifon Uzebba Road - Ose River Bridge (Edo State Border)",
        "Senatorial District": "Ondo Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/23/2021 19:11:31",
        "Score": "0",
        "Road Name": "Sobe Okulese Road",
        "Senatorial District": "Ondo Centrsl",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/23/2021 21:08:14",
        "Score": "0",
        "Road Name": "Ipele Kabba Road",
        "Senatorial District": "Ondo North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/24/2021 11:14:15",
        "Score": "0",
        "Road Name": "Owo Oyin Ekiti Road",
        "Senatorial District": "Ondo North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/10/2021 16:48:05",
        "Score": "0",
        "Road Name": "Ado-Ekiti Ikare Road",
        "Senatorial District": "Ondo North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/24/2021 14:27:55",
        "Score": "0",
        "Road Name": "Ore Okitipupa Road",
        "Senatorial District": "Ondo South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/25/2021 20:46:04",
        "Score": "0",
        "Road Name": "Ore Ondo Road",
        "Senatorial District": "Ondo South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/10/2021 17:12:09",
        "Score": "0",
        "Road Name": "Ondo Okeigbo Road",
        "Senatorial District": "Ondo. South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/20/2021 11:37:58",
        "Score": "0",
        "Road Name": "OSOGBO - OKUKU",
        "Senatorial District": "OSUN CENTRAL",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/19/2021 10:27:35",
        "Score": "0",
        "Road Name": "Osogbo - Ilesa Road",
        "Senatorial District": "Osun Central / East",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/23/2021 19:52:43",
        "Score": "0",
        "Road Name": "OSOGBO - IWO - OYO S/B ROAD",
        "Senatorial District": "OSUN CENTRAL/WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 18:27:10",
        "Score": "0",
        "Road Name": "SEKONA - IFE",
        "Senatorial District": "OSUN EAST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 19:06:33",
        "Score": "0",
        "Road Name": "IFE - IFETEDO",
        "Senatorial District": "OSUN EAST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/20/2021 17:23:52",
        "Score": "0",
        "Road Name": "Ipetu - ijesa - Apoti Ondo S/B Road",
        "Senatorial District": "OSUN EAST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/20/2021 17:35:52",
        "Score": "0",
        "Road Name": "ILESA - OWENA - ONDO S/B ROAD",
        "Senatorial District": "OSUN EAST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/20/2021 17:49:17",
        "Score": "0",
        "Road Name": "IFE - ILESA DUAL CARRIAGEWAY ROAD",
        "Senatorial District": "OSUN EAST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/19/2021 10:40:47",
        "Score": "0",
        "Road Name": "Ilesa - Ijebu-Jesa Ekiti S/B Road",
        "Senatorial District": "Osun East",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 19:47:14",
        "Score": "0",
        "Road Name": "OSOGBO - SEKONA - ODE-OMU",
        "Senatorial District": "OSUN WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 19:36:45",
        "Score": "0",
        "Road Name": "IWO - OYO",
        "Senatorial District": "OSUN WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/22/2021 7:24:59",
        "Score": "0",
        "Road Name": "Oyo/ Ogbomosho Road",
        "Senatorial District": "OYO CENTRAL",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/15/2021 9:34:36",
        "Score": "0",
        "Road Name": "Oyo/Awe Road",
        "Senatorial District": "Oyo Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/15/2021 13:14:11",
        "Score": "0",
        "Road Name": "Iwo Road - Monantan - Lalupon - Osun (Ibadan Bound)",
        "Senatorial District": "Oyo Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/18/2021 9:06:12",
        "Score": "0",
        "Road Name": "Ibadan/Oyo Old Road",
        "Senatorial District": "Oyo Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/18/2021 21:04:35",
        "Score": "0",
        "Road Name": "Ogbomosho - Otte Dual C/W",
        "Senatorial District": "Oyo Central/Oyo North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/22/2021 0:37:56",
        "Score": "0",
        "Road Name": "Igbeti/Kishi Road",
        "Senatorial District": "OYO NORTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/22/2021 7:17:02",
        "Score": "0",
        "Road Name": "Ogbomosho/Igbeti Road",
        "Senatorial District": "OYO NORTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/22/2021 7:31:29",
        "Score": "0",
        "Road Name": "Iseyin/Maya Road",
        "Senatorial District": "Oyo North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/16/2021 12:18:41",
        "Score": "0",
        "Road Name": "Iseyin - Ago Are - Sepeteri - Igboho Road",
        "Senatorial District": "Oyo North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/16/2021 14:00:47",
        "Score": "0",
        "Road Name": "Ago Are - Shaki Road",
        "Senatorial District": "Oyo North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/16/2021 17:27:10",
        "Score": "0",
        "Road Name": "Iseyin - Okeho Road",
        "Senatorial District": "Oyo North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/18/2021 21:12:52",
        "Score": "0",
        "Road Name": "Ogbomosho - Otte Old Road",
        "Senatorial District": "Oyo North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/22/2021 0:49:44",
        "Score": "0",
        "Road Name": "Ibadan/Oyo Road",
        "Senatorial District": "OYO SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/15/2021 10:37:35",
        "Score": "0",
        "Road Name": "Ibadan (Molete) - Idi Ayunre - Ogunmakin Road",
        "Senatorial District": "Oyo South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "11/15/2021 11:33:31",
        "Score": "0",
        "Road Name": "Odo Ona (Ibadan) - Idi Ayunre - Mamu (Ogun S/B) Road",
        "Senatorial District": "Oyo South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/24/2021 20:44:58",
        "Score": "0",
        "Road Name": "Guduk-Bashar Raod",
        "Senatorial District": "Plateau Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/24/2021 20:54:17",
        "Score": "0",
        "Road Name": "Gar-namarang- Kaphil Road",
        "Senatorial District": "Plateau Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 20:53:34",
        "Score": "0",
        "Road Name": "Jos - Bauchi State Border Raod",
        "Senatorial District": "Plateau North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/21/2021 21:12:48",
        "Score": "0",
        "Road Name": "Vom - Manchok - Kaduna Road",
        "Senatorial District": "Plateau North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/22/2021 15:38:50",
        "Score": "0",
        "Road Name": "Vom - Manchok - Kaduna Road",
        "Senatorial District": "Plateau North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/24/2021 20:38:18",
        "Score": "0",
        "Road Name": "Shendam - Nassarawa State Border Road",
        "Senatorial District": "Plateau South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/16/2021 19:46:03",
        "Score": "0",
        "Road Name": "Omagwua - Elele - Omerelu road",
        "Senatorial District": "River East",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/16/2021 19:53:02",
        "Score": "0",
        "Road Name": "Elele - Alumini road",
        "Senatorial District": "River East",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/16/2021 20:09:06",
        "Score": "0",
        "Road Name": "Ahoada -",
        "Senatorial District": "River West",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/16/2021 23:01:42",
        "Score": "0",
        "Road Name": "Emohua -Tema - Buguma road",
        "Senatorial District": "River West",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/16/2021 23:05:26",
        "Score": "0",
        "Road Name": "Tema - Degema - Abonnema road",
        "Senatorial District": "River West",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/27/2021 16:31:52",
        "Score": "0",
        "Road Name": "SOKOTO ILLELA ROAD",
        "Senatorial District": "SOKOTO EAST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/25/2021 13:08:42",
        "Score": "0",
        "Road Name": "SOKOTO ARGUNGU ROAD",
        "Senatorial District": "Sokoto North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/27/2021 15:29:55",
        "Score": "0",
        "Road Name": "SOKOTO ARGUNGU ROAD",
        "Senatorial District": "SOKOTO NORTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/25/2021 12:24:38",
        "Score": "0",
        "Road Name": "SOKOTO ARGUNGU ROAD",
        "Senatorial District": "SOKOTO North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/24/2021 0:49:44",
        "Score": "0",
        "Road Name": "SOKOTO GUSAU ROAD",
        "Senatorial District": "SOKOTO SOUTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/24/2021 19:08:07",
        "Score": "0",
        "Road Name": "Bali- Takum Road, Nigeria",
        "Senatorial District": "Taraba Central",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/24/2021 17:58:43",
        "Score": "0",
        "Road Name": "Zing- Mayo Belwa Road, Nigeria",
        "Senatorial District": "Taraba North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/24/2021 18:13:02",
        "Score": "0",
        "Road Name": "Lankoviri- Lau Road, 661101, Lau, Nigeria",
        "Senatorial District": "Taraba North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/24/2021 18:33:10",
        "Score": "0",
        "Road Name": "Jalingo-Mutum Biyu-Tella Road, Nigeria",
        "Senatorial District": "Taraba North",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/24/2021 18:40:12",
        "Score": "0",
        "Road Name": "Matum Biyu-Tella Road, Nigeria",
        "Senatorial District": "Taraba South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "9/24/2021 19:14:40",
        "Score": "0",
        "Road Name": "Mararaba- Takum Road, Nigeria",
        "Senatorial District": "Taraba South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/3/2021 8:02:12",
        "Score": "0",
        "Road Name": "Gashua/Damaturu Road",
        "Senatorial District": "Yobe north",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/6/2021 6:57:13",
        "Score": "0",
        "Road Name": "Baimari gashu,a yusufari karasuwa nguru",
        "Senatorial District": "Yobe North zone c",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/22/2021 8:11:17",
        "Score": "0",
        "Road Name": "Patiskum to nganda",
        "Senatorial District": "Yobe south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/22/2021 10:22:29",
        "Score": "0",
        "Road Name": "Patiskum jakusko to garin alkali",
        "Senatorial District": "Yobe South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/23/2021 14:26:46",
        "Score": "0",
        "Road Name": "Nangere gamawa road",
        "Senatorial District": "Yobe South",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/6/2021 14:49:34",
        "Score": "0",
        "Road Name": "Patiskum",
        "Senatorial District": "Yobe south",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/5/2021 7:12:57",
        "Score": "0",
        "Road Name": "Baimari geidam damaturu gashu,a",
        "Senatorial District": "Yobe South state zone A and zone B",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/26/2021 21:16:20",
        "Score": "0",
        "Road Name": "GUSAU _MAINCHI JUNCTION ROAD, GADA BIU ROUND ABOUT GUSAU, ZAMFARA STATE.",
        "Senatorial District": "ZAMFARA CENTRAL",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/27/2021 4:57:17",
        "Score": "0",
        "Road Name": "KAURA NAMODA_ZURMI_KATSINA BORDER ROAD, ZURMI, ZAMFARA STATE.",
        "Senatorial District": "ZAMFARA NORTH",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/27/2021 4:49:35",
        "Score": "0",
        "Road Name": "GUSAU_KAURA NAMODA ROAD, KAURA NAMODA, ZAMFARA STATE.",
        "Senatorial District": "ZAMFARA NORTH.",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/26/2021 21:46:00",
        "Score": "0",
        "Road Name": "MAINCHI_TALATA MAFARA JUNCTION ROAD, MAINCHI, ZAMFARA STATE.",
        "Senatorial District": "ZAMFARA WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/26/2021 22:23:36",
        "Score": "0",
        "Road Name": "TALATA MAFARA_SOKOTO STATE BORDER ROAD, TALATA MAFARA, ZAMFARA STATE.",
        "Senatorial District": "ZAMFARA WEST",
        "null": null,
        "": ""
    },
    {
        "Timestamp": "10/27/2021 4:40:49",
        "Score": "0",
        "Road Name": "MAINCHI _ANKA ROAD, ANKA, ZAMFARA STATE.",
        "Senatorial District": "ZAMFARA WEST",
        "null": null,
        "": null
    }
]';


  //var_dump(json_decode($roads, true));

  // foreach (json_decode($roads, true) as $key => $value) {

  //   print $value['Road Name'] . "<br/>";
  // }




  // foreach (\App\Models\State::all() as $state) {

  //   foreach (json_decode($roads, true) as  $key => $value) {


  //     if (preg_match("/$state->name/i",  $value['Senatorial District'])) {

  //       \App\Models\StateRoad::create([
  //         'name' => $value['Road Name'],
  //         'district' => $value['Senatorial District'],
  //         'state_id' => $state->id
  //       ]);

  //       //print $state->name . "###" . $value['Road Name'] . "###" . $value['Senatorial District'] . "<br/>";
  //     }

  //   }
  // }

  // foreach (\App\Models\StateRoad::all() as $stroad) {
  //   print $stroad . "<br/>";
  // }
});
