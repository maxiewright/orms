<?php

namespace Database\Seeders\Contact;

use App\Models\Metadata\Contact\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run()
    {
        $cities = [
            [
                'name' => 'Adelphi',
                'division_id' => 15,
            ],
            [
                'name' => 'Adventure',
                'division_id' => 15,
            ],
            [
                'name' => 'Agostini',
                'division_id' => 1,
            ],
            [
                'name' => 'Anse Fourmi',
                'division_id' => 15,
            ],
            [
                'name' => 'Anse Noire',
                'division_id' => 6,
            ],
            [
                'name' => 'Arden',
                'division_id' => 15,
            ],
            [
                'name' => 'Arima',
                'division_id' => 10,
            ],
            [
                'name' => 'Arnos Vale',
                'division_id' => 15,
            ],
            [
                'name' => 'Arouca',
                'division_id' => 9,
            ],
            [
                'name' => 'Arundel ',
                'division_id' => 9,
            ],
            [
                'name' => 'Auchenskeoch',
                'division_id' => 15,
            ],
            [
                'name' => 'Avocat',
                'division_id' => 8,
            ],
            //**************************************************************************** B - City or Town ***********************************************************************
            [
                'name' => 'Bacolet',
                'division_id' => 15,
            ],
            [
                'name' => 'Bakhen',
                'division_id' => 4,
            ],
            [
                'name' => 'Balmain',
                'division_id' => 1,
            ],
            [
                'name' => 'Balmain Village',
                'division_id' => 1,
            ],
            [
                'name' => 'Bamboo',
                'division_id' => 8,
            ],
            [
                'name' => 'Bande-de-l’Est',
                'division_id' => 3,
            ],
            [
                'name' => 'Barataria',
                'division_id' => 7,
            ],
            [
                'name' => 'Barrackpore',
                'division_id' => 4,
            ],
            [
                'name' => 'Barrackpore Settlement',
                'division_id' => 4,
            ],
            [
                'name' => 'Basse Terre',
                'division_id' => 5,
            ],
            [
                'name' => 'Basseterre',
                'division_id' => 5,
            ],
            [
                'name' => 'Basterhall',
                'division_id' => 1,
            ],
            [
                'name' => 'Bayshore',
                'division_id' => 2,
            ],
            [
                'name' => 'Belle Garden',
                'division_id' => 15,
            ],
            [
                'name' => 'Belle Vue',
                'division_id' => 9,
            ],
            [
                'name' => 'Belmont',
                'division_id' => 13,
            ],
            [
                'name' => 'Belmont',
                'division_id' => 15,
            ],
            [
                'name' => 'Bethel',
                'division_id' => 15,
            ],
            [
                'name' => 'Biche',
                'division_id' => 3,
            ],
            [
                'name' => 'Biche Village',
                'division_id' => 3,
            ],
            [
                'name' => 'Black Rock',
                'division_id' => 15,
            ],
            [
                'name' => 'Blanchisseuse',
                'division_id' => 9,
            ],
            [
                'name' => 'Blue Basin',
                'division_id' => 1,
            ],
            [
                'name' => 'Boissiere',
                'division_id' => 13,
            ],
            [
                'name' => 'Bon Accord',
                'division_id' => 15,
            ],
            [
                'name' => 'Bonasse',
                'division_id' => 8,
            ],
            [
                'name' => 'Bonne Aventure',
                'division_id' => 1,
            ],
            [
                'name' => 'Bonne Terre',
                'division_id' => 5,
            ],
            [
                'name' => 'Brasso',
                'division_id' => 1,
            ],
            [
                'name' => 'Brasso Caparo Village',
                'division_id' => 1,
            ],
            [
                'name' => 'Brasso Piedra',
                'division_id' => 1,
            ],
            [
                'name' => 'Brasso Seco',
                'division_id' => 9,
            ],
            [
                'name' => 'Brasso Venado',
                'division_id' => 1,
            ],
            [
                'name' => 'Brasso Village',
                'division_id' => 1,
            ],
            [
                'name' => 'Brazil',
                'division_id' => 1,
            ],
            [
                'name' => 'Brickfield',
                'division_id' => 1,
            ],
            [
                'name' => 'Brighton',
                'division_id' => 8,
            ],
            [
                'name' => 'Bronte',
                'division_id' => 4,
            ],
            [
                'name' => 'Buccoo',
                'division_id' => 15,
            ],
            [
                'name' => 'Buen Intento',
                'division_id' => 5,
            ],
            [
                'name' => 'Buenos Aires',
                'division_id' => 8,
            ],
            [
                'name' => 'Busy Corner',
                'division_id' => 5,
            ],
            [
                'name' => 'Butler',
                'division_id' => 1,
            ],

            //**************************************************************************** D - City or Town ***********************************************************************

            [
                'name' => 'Cacandee Settlement',
                'division_id' => 11,
            ],
            [
                'name' => 'Caigual',
                'division_id' => 6,
            ],
            [
                'name' => 'Calcutta Settlement',
                'division_id' => 1,
            ],
            [
                'name' => 'Calder Hall',
                'division_id' => 15,
            ],
            [
                'name' => 'California',
                'division_id' => 1,
            ],
            [
                'name' => 'California Village',
                'division_id' => 1,
            ],
            [
                'name' => 'Cambleton',
                'division_id' => 15,
            ],
            [
                'name' => 'Cameron',
                'division_id' => 2,
            ],
            [
                'name' => 'Campbeltown',
                'division_id' => 15,
            ],
            [
                'name' => 'Canaan',
                'division_id' => 4,
            ],
            [
                'name' => 'Canaan',
                'division_id' => 15,
            ],
            [
                'name' => 'Cantaro',
                'division_id' => 7,
            ],
            [
                'name' => 'Caparo',
                'division_id' => 1,
            ],
            [
                'name' => 'Cape-de-Ville',
                'division_id' => 12,
            ],
            [
                'name' => 'Carapichaima',
                'division_id' => 1,
            ],
            [
                'name' => 'Carapo',
                'division_id' => 9,
            ],
            [
                'name' => 'Caratal',
                'division_id' => 1,
            ],
            [
                'name' => 'Cardiff',
                'division_id' => 15,
            ],
            [
                'name' => 'Carenage',
                'division_id' => 2,
            ],

            [
                'name' => 'Carmichael',
                'division_id' => 6,
            ],
            [
                'name' => 'Carnbee Village',
                'division_id' => 15,
            ],
            [
                'name' => 'Carolina',
                'division_id' => 1,
            ],
            [
                'name' => 'Caroni',
                'division_id' => 9,
            ],
            [
                'name' => 'Castara',
                'division_id' => 15,
            ],
            [
                'name' => 'Caura',
                'division_id' => 9,
            ],
            [
                'name' => 'Centento',
                'division_id' => 9,
            ],
            [
                'name' => 'Chaguanas',
                'division_id' => 11,
            ],
            [
                'name' => 'Chaguaramas',
                'division_id' => 2,
            ],
            [
                'name' => 'Charlotteville',
                'division_id' => 15,
            ],
            [
                'name' => 'Charuma',
                'division_id' => 3,
            ],
            [
                'name' => 'Chase',
                'division_id' => 1,
            ],
            [
                'name' => 'Chase Village',
                'division_id' => 1,
            ],
            [
                'name' => 'Chatham',
                'division_id' => 8,
            ],
            [
                'name' => 'Cheeyou',
                'division_id' => 6,
            ],
            [
                'name' => 'Chickland',
                'division_id' => 1,
            ],
            [
                'name' => 'Chin Chin Savanna Village',
                'division_id' => 1,
            ],
            [
                'name' => 'Cinnamon Hill',
                'division_id' => 15,
            ],
            [
                'name' => 'Cipero-Sainte Croix',
                'division_id' => 4,
            ],
            [
                'name' => 'City of Port-of-Spain',
                'division_id' => 13,
            ],
            [
                'name' => 'Claxton Bay',
                'division_id' => 1,
            ],
            [
                'name' => 'Cochrane',
                'division_id' => 12,
            ],
            [
                'name' => 'Coco',
                'division_id' => 2,
            ],
            [
                'name' => 'Cocorite',
                'division_id' => 2,
            ],
            [
                'name' => 'Coffee',
                'division_id' => 14,
            ],
            [
                'name' => 'Colconda',
                'division_id' => 4,
            ],
            [
                'name' => 'Comparo',
                'division_id' => 6,
            ],
            [
                'name' => 'Concord',
                'division_id' => 4,
            ],
            [
                'name' => 'Concordia',
                'division_id' => 15,
            ],
            [
                'name' => 'Coolie Block',
                'division_id' => 2,
            ],
            [
                'name' => 'Corbeaux Town',
                'division_id' => 13,
            ],
            [
                'name' => 'Coromandel Settlement',
                'division_id' => 8,
            ],
            [
                'name' => 'Coryal',
                'division_id' => 1,
            ],
            [
                'name' => 'Coryal',
                'division_id' => 6,
            ],
            [
                'name' => 'Courland',
                'division_id' => 15,
            ],
            [
                'name' => 'Couva',
                'division_id' => 1,
            ],
            [
                'name' => 'Couva Savannah',
                'division_id' => 1,
            ],
            [
                'name' => 'Cove',
                'division_id' => 15,
            ],
            [
                'name' => 'Craignish',
                'division_id' => 5,
            ],
            [
                'name' => 'Crown',
                'division_id' => 9,
            ],
            [
                'name' => 'Cuche',
                'division_id' => 3,
            ],
            [
                'name' => 'Culloden',
                'division_id' => 15,
            ],
            [
                'name' => 'Cumaca',
                'division_id' => 6,
            ],
            [
                'name' => 'Cumberbatch',
                'division_id' => 11,
            ],
            [
                'name' => 'Cumuto',
                'division_id' => 6,
            ],
            [
                'name' => 'Cumuto Village',
                'division_id' => 6,
            ],
            [
                'name' => 'Cunapo',
                'division_id' => 6,
            ],
            [
                'name' => 'Cunapo',
                'division_id' => 9,
            ],
            [
                'name' => 'Cunaripa',
                'division_id' => 6,
            ],
            [
                'name' => 'Cunupia',
                'division_id' => 11,
            ],
            [
                'name' => 'Curepe',
                'division_id' => 9,
            ],
            [
                'name' => 'Curucaye',
                'division_id' => 7,
            ],
            //**************************************************************************** D - City or Town ***********************************************************************
            [
                'name' => 'Debe',
                'division_id' => 4,
            ],
            [
                'name' => 'Debe Village',
                'division_id' => 4,
            ],
            [
                'name' => 'Delaford',
                'division_id' => 15,
            ],
            [
                'name' => 'Delhi Settlement',
                'division_id' => 8,
            ],
            [
                'name' => 'Diamond',
                'division_id' => 1,
            ],
            [
                'name' => 'Diamond',
                'division_id' => 4,
            ],
            [
                'name' => 'Dibe',
                'division_id' => 2,
            ],
            [
                'name' => 'Diego Martin',
                'division_id' => 2,
            ],
            [
                'name' => 'Dinsley',
                'division_id' => 9,
            ],
            [
                'name' => 'Dow',
                'division_id' => 1,
            ],
            [
                'name' => 'Duncan',
                'division_id' => 4,
            ],
            [
                'name' => 'D’Abadie',
                'division_id' => 9,
            ],

            //****************************************************** E - City or Town *********************************************************
            [
                'name' => 'Earthigg',
                'division_id' => 7,
            ],
            [
                'name' => 'East Dry River',
                'division_id' => 13,
            ],
            [
                'name' => 'Easterfield',
                'division_id' => 15,
            ],
            [
                'name' => 'Eckel Ville',
                'division_id' => 5,
            ],
            [
                'name' => 'Edinburgh',
                'division_id' => 11,
            ],
            [
                'name' => 'El Chorro',
                'division_id' => 9,
            ],
            [
                'name' => 'El Dorado',
                'division_id' => 9,
            ],
            [
                'name' => 'El Quemado',
                'division_id' => 1,
            ],
            [
                'name' => 'El Socorro',
                'division_id' => 7,
            ],
            [
                'name' => 'Englishman’s Bay',
                'division_id' => 15,
            ],
            [
                'name' => 'Enterprise',
                'division_id' => 11,
            ],
            [
                'name' => 'Erin',
                'division_id' => 8,
            ],
            [
                'name' => 'Erthig',
                'division_id' => 7,
            ],
            [
                'name' => 'Esperance',
                'division_id' => 4,
            ],
            [
                'name' => 'Exchange',
                'division_id' => 1,
            ],

            // ******************************************************** F- City or Town ********************************************************

            [
                'name' => 'Febeau',
                'division_id' => 7,
            ],
            [
                'name' => 'Felicity',
                'division_id' => 11,
            ],
            [
                'name' => 'Felicity Hall',
                'division_id' => 1,
            ],
            [
                'name' => 'Fifth Company',
                'division_id' => 5,
            ],
            [
                'name' => 'Fillette',
                'division_id' => 7,
            ],
            [
                'name' => 'Flanagin Town',
                'division_id' => 1,
            ],
            [
                'name' => 'Florida',
                'division_id' => 15,
            ],
            [
                'name' => 'Fonrose',
                'division_id' => 3,
            ],
            [
                'name' => 'Forres Park',
                'division_id' => 1,
            ],
            [
                'name' => 'Four Roads',
                'division_id' => 1,
            ],
            [
                'name' => 'Four Roads',
                'division_id' => 2,
            ],
            [
                'name' => 'Fourth Company',
                'division_id' => 5,
            ],
            [
                'name' => 'Francique Village',
                'division_id' => 8,
            ],
            [
                'name' => 'Franklyns',
                'division_id' => 15,
            ],
            [
                'name' => 'Frederick Village',
                'division_id' => 9,
            ],
            [
                'name' => 'Freeport',
                'division_id' => 1,
            ],
            [
                'name' => 'Friendsfield',
                'division_id' => 15,
            ],
            [
                'name' => 'Friendship',
                'division_id' => 1,
            ],
            [
                'name' => 'Friendship',
                'division_id' => 15,
            ],
            [
                'name' => 'Fullarton',
                'division_id' => 8,
            ],
            [
                'name' => 'Fyzabad',
                'division_id' => 8,
            ],

            // ************************************************************************* G - City or town ************************************************************

            [
                'name' => 'Gasparillo',
                'division_id' => 1,
            ],

            [
                'name' => 'George Village',
                'division_id' => 5,
            ],
            [
                'name' => 'Glamorgan',
                'division_id' => 15,
            ],
            [
                'name' => 'Glencoe',
                'division_id' => 2,
            ],
            [
                'name' => 'Golconda',
                'division_id' => 4,
            ],
            [
                'name' => 'Golden Grove',
                'division_id' => 15,
            ],
            [
                'name' => 'Golden Lane',
                'division_id' => 15,
            ],
            [
                'name' => 'Goldsborough',
                'division_id' => 15,
            ],
            [
                'name' => 'Gonzales',
                'division_id' => 7,
            ],
            [
                'name' => 'Goodwood',
                'division_id' => 15,
            ],
            [
                'name' => 'Goodwood Park',
                'division_id' => 2,
            ],
            [
                'name' => 'Gordon Settlement',
                'division_id' => 1,
            ],
            [
                'name' => 'Gordon Settlement',
                'division_id' => 5,
            ],
            [
                'name' => 'Grafton',
                'division_id' => 15,
            ],
            [
                'name' => 'Gran Couva',
                'division_id' => 1,
            ],
            [
                'name' => 'Grand Fond',
                'division_id' => 3,
            ],
            [
                'name' => 'Grande Riviere',
                'division_id' => 6,
            ],
            [
                'name' => 'Grange',
                'division_id' => 15,
            ],
            [
                'name' => 'Granville',
                'division_id' => 8,
            ],
            [
                'name' => 'Green Hill',
                'division_id' => 2,
            ],
            [
                'name' => 'Green Hill',
                'division_id' => 15,
            ],
            [
                'name' => 'Greenhill Village',
                'division_id' => 2,
            ],
            [
                'name' => 'Groogroo',
                'division_id' => 9,
            ],
            [
                'name' => 'Guaico',
                'division_id' => 6,
            ],
            [
                'name' => 'Guaico Tamana',
                'division_id' => 6,
            ],
            [
                'name' => 'Guamal',
                'division_id' => 7,
            ],
            [
                'name' => 'Guanapo',
                'division_id' => 9,
            ],
            [
                'name' => 'Guapo',
                'division_id' => 12,
            ],
            [
                'name' => 'Guaracara Junction',
                'division_id' => 1,
            ],
            [
                'name' => 'Guarata',
                'division_id' => 9,
            ],
            [
                'name' => 'Guayaguayare',
                'division_id' => 3,
            ], [
                'name' => 'Gunapo',
                'division_id' => 9,
            ],

            //************************************************************** H - City Or Town *************************************************************************
            [
                'name' => 'Hardbargain',
                'division_id' => 5,
            ],
            [
                'name' => 'Harmony Hall',
                'division_id' => 15,
            ],
            [
                'name' => 'Harts Cut',
                'division_id' => 2,
            ],
            [
                'name' => 'Hasnally',
                'division_id' => 6,
            ],
            [
                'name' => 'Haswaron',
                'division_id' => 5,
            ],
            [
                'name' => 'Hermitage',
                'division_id' => 1,
            ],
            [
                'name' => 'Hermitage',
                'division_id' => 4,
            ],
            [
                'name' => 'Hermitage',
                'division_id' => 15,
            ],
            [
                'name' => 'Hillsborough',
                'division_id' => 15,
            ],
            [
                'name' => 'Hindustan',
                'division_id' => 5,
            ],
            [
                'name' => 'Homard',
                'division_id' => 6,
            ],
            [
                'name' => 'Hope',
                'division_id' => 15,
            ],
            [
                'name' => 'Howson',
                'division_id' => 6,
            ],
            [
                'name' => 'Hubert’s Town',
                'division_id' => 12,
            ],

            //************************************************************* I - City or Town ************************************************************************
            [
                'name' => 'Icacos',
                'division_id' => 8,
            ],
            [
                'name' => 'Iere',
                'division_id' => 5,
            ],
            [
                'name' => 'Indian Chain',
                'division_id' => 1,
            ],
            [
                'name' => 'Indian Walk',
                'division_id' => 5,
            ],
            [
                'name' => 'Irois',
                'division_id' => 8,
            ],

            //************************************************************* J - City or Town ************************************************************************

            [
                'name' => 'Jaitoo',
                'division_id' => 1,
            ],
            [
                'name' => 'James Smart',
                'division_id' => 6,
            ],
            [
                'name' => 'James Stewart',
                'division_id' => 6,
            ],
            [
                'name' => 'Jaraysingh',
                'division_id' => 6,
            ],
            [
                'name' => 'Jerningham Junction',
                'division_id' => 11,
            ],

            //************************************************************* K - City or Town ************************************************************************

            [
                'name' => 'Kelly Junction',
                'division_id' => 1,
            ],
            [
                'name' => 'Kelly Village',
                'division_id' => 9,
            ],
            [
                'name' => 'Kilgwyn',
                'division_id' => 15,
            ],
            [
                'name' => 'King’s Bay',
                'division_id' => 15,
            ],

            //************************************************************* L - City or Town ************************************************************************
            [
                'name' => 'L Anse Noire ',
                'division_id' => 6,
            ],

            [
                'name' => 'La Basse',
                'division_id' => 7,
            ],
            [
                'name' => 'La Brea',
                'division_id' => 8,
            ],
            [
                'name' => 'La Carriere',
                'division_id' => 1,
            ],
            [
                'name' => 'La Finette',
                'division_id' => 2,
            ],
            [
                'name' => 'La Lune',
                'division_id' => 5,
            ],
            [
                'name' => 'La Pastora',
                'division_id' => 7,
            ],
            [
                'name' => 'La Pastora',
                'division_id' => 9,
            ],
            [
                'name' => 'La Pastoria',
                'division_id' => 9,
            ],
            [
                'name' => 'La Pique',
                'division_id' => 14,
            ],
            [
                'name' => 'La Plata',
                'division_id' => 9,
            ],
            [
                'name' => 'La Retraite',
                'division_id' => 2,
            ],
            [
                'name' => 'La Romain',
                'division_or_regionid' => 14,
            ],
            [
                'name' => 'La Veronica',
                'division_id' => 9,
            ],
            [
                'name' => 'Lambeau',
                'division_id' => 15,
            ],
            [
                'name' => 'Lapai Village',
                'division_id' => 9,
            ],
            [
                'name' => 'Las Cuevas',
                'division_id' => 7,
            ],
            [
                'name' => 'Las Lomas',
                'division_id' => 1,
            ],
            [
                'name' => 'Laventille',
                'division_id' => 7,
            ],
            [
                'name' => 'Lendor',
                'division_id' => 11,
            ],
            [
                'name' => 'Lengua',
                'division_id' => 5,
            ],
            [
                'name' => 'Les Coteaux',
                'division_id' => 15,
            ],
            [
                'name' => 'Libertville',
                'division_id' => 3,
            ],
            [
                'name' => 'Loango',
                'division_id' => 9,
            ],
            [
                'name' => 'Longdenville',
                'division_id' => 11,
            ],
            [
                'name' => 'Lopinot',
                'division_id' => 9,
            ],
            [
                'name' => 'Los Atajos',
                'division_id' => 1,
            ],
            [
                'name' => 'Los Bajos',
                'division_id' => 8,
            ],
            [
                'name' => 'Lothian',
                'division_id' => 5,
            ],
            [
                'name' => 'Lower Fishing Pound',
                'division_id' => 6,
            ],

            [
                'name' => 'Lower Manzanilla',
                'division_id' => 6,
            ],
            [
                'name' => 'Lower Quarter',
                'division_id' => 15,
            ],
            [
                'name' => 'Lower Town',
                'division_id' => 15,
            ],
            [
                'name' => 'Lowlands ',
                'division_id' => 15,
            ],

            //********************************************************* M - Town or City ****************************************************************************

            [
                'name' => 'Madras Settlement',
                'division_id' => 1,
            ],
            [
                'name' => 'Mairad Village',
                'division_id' => 5,
            ],
            [
                'name' => 'Malabar Settlement',
                'division_id' => 10,
            ],
            [
                'name' => 'Mamon',
                'division_id' => 6,
            ],
            [
                'name' => 'Mamoral',
                'division_id' => 1,
            ],
            [
                'name' => 'Mamural',
                'division_id' => 1,
            ],
            [
                'name' => 'Manahambre',
                'division_id' => 5,
            ],
            [
                'name' => 'Marabella',
                'division_id' => 14,
            ],
            [
                'name' => 'Maracas',
                'division_id' => 9,
            ],
            [
                'name' => 'Maracas Bay',
                'division_id' => 7,
            ],
            [
                'name' => 'Maraval',
                'division_id' => 2,
            ],
            [
                'name' => 'Mary’s Hill',
                'division_id' => 15,
            ],
            [
                'name' => 'Mason Hall',
                'division_id' => 15,
            ],
            [
                'name' => 'Matelot',
                'division_id' => 6,
            ],
            [
                'name' => 'Matura',
                'division_id' => 6,
            ],
            [
                'name' => 'Maturita',
                'division_id' => 9,
            ],
            [
                'name' => 'Mayaro',
                'division_id' => 3,
            ],
            [
                'name' => 'Mayo',
                'division_id' => 1,
            ],
            [
                'name' => 'Mc Bean',
                'division_id' => 1,
            ],
            [
                'name' => 'Merchiston',
                'division_id' => 15,
            ],
            [
                'name' => 'Mesopotamia',
                'division_id' => 15,
            ],
            [
                'name' => 'Mitan',
                'division_id' => 3,
            ],
            [
                'name' => 'Mon Plaisir',
                'division_id' => 9,
            ],
            [
                'name' => 'Mon Repos',
                'division_id' => 14,
            ],
            [
                'name' => 'Monkey Town',
                'division_id' => 4,
            ],
            [
                'name' => 'Monkey Town',
                'division_id' => 5,
            ],
            [
                'name' => 'Monte Video',
                'division_id' => 6,
            ],
            [
                'name' => 'Montgomery',
                'division_id' => 15,
            ],
            [
                'name' => 'Montrose',
                'division_id' => 11,
            ],
            [
                'name' => 'Montrose',
                'division_id' => 15,
            ],
            [
                'name' => 'Montserrat Village',
                'division_id' => 1,
            ],
            [
                'name' => 'Moos',
                'division_id' => 5,
            ],
            [
                'name' => 'Moque Point',
                'division_id' => 4,
            ],
            [
                'name' => 'Moriah',
                'division_id' => 15,
            ],
            [
                'name' => 'Morichal',
                'division_id' => 1,
            ],
            [
                'name' => 'Morne Cabrite',
                'division_id' => 6,
            ],
            [
                'name' => 'Morne Diablo',
                'division_id' => 4,
            ],
            [
                'name' => 'Morne Quiton',
                'division_id' => 15,
            ],
            [
                'name' => 'Moruga',
                'division_id' => 5,
            ],
            [
                'name' => 'Morvant',
                'division_id' => 7,
            ],
            [
                'name' => 'Mount Dillon',
                'division_id' => 15,
            ],
            [
                'name' => 'Mount Grace',
                'division_id' => 15,
            ],
            [
                'name' => 'Mount Harris',
                'division_id' => 6,
            ],
            [
                'name' => 'Mount Pleasant',
                'division_id' => 2,
            ],
            [
                'name' => 'Mount Pleasant',
                'division_id' => 15,
            ],
            [
                'name' => 'Mount Saint Georg',
                'division_id' => 15,
            ],
            [
                'name' => 'Mount Stewart',
                'division_id' => 5,
            ],
            [
                'name' => 'Mount Stewart Village',
                'division_id' => 5,
            ],
            [
                'name' => 'Mount Thomas',
                'division_id' => 15,
            ],
            [
                'name' => 'Mouville',
                'division_id' => 3,
            ],
            [
                'name' => 'Mucurapo',
                'division_id' => 13,
            ],
            [
                'name' => 'Mundo Nuevo',
                'division_id' => 1,
            ],

            // ************************************************************************* N - City 0r Town **************************************************************
            [
                'name' => 'Nancoo Village',
                'division_id' => 1,
            ],
            [
                'name' => 'Naranjo',
                'division_id' => 6,
            ],
            [
                'name' => 'Navet',
                'division_id' => 3,
            ],
            [
                'name' => 'Nestor',
                'division_id' => 6,
            ],
            [
                'name' => 'New Grant',
                'division_id' => 5,
            ],
            [
                'name' => 'New Jersey',
                'division_id' => 8,
            ],
            [
                'name' => 'Newtown',
                'division_id' => 13,
            ],
            [
                'name' => 'Noire Bay',
                'division_id' => 6,
            ],
            [
                'name' => 'North Manzanilla',
                'division_id' => 6,
            ],
            [
                'name' => 'Nutmeg Grove',
                'division_id' => 15,
            ],
            // ************************************************************************* O - City 0r Town **************************************************************
            [
                'name' => 'Ogis',
                'division_id' => 6,
            ],
            [
                'name' => 'Orange Hill',
                'division_id' => 15,
            ],
            [
                'name' => 'Orange Valley',
                'division_id' => 1,
            ],
            [
                'name' => 'Oropuche',
                'division_id' => 6,
            ],
            [
                'name' => 'Oropuche',
                'division_id' => 8,
            ],
            [
                'name' => 'Ortinola',
                'division_id' => 9,
            ],
            [
                'name' => 'Ouplay',
                'division_id' => 1,
            ],
            // ************************************************************************* P - City 0r Town **************************************************************
            [
                'name' => 'Palmiste',
                'division_id' => 1,
            ],
            [
                'name' => 'Palmiste',
                'division_id' => 14,
            ],
            [
                'name' => 'Palmyra',
                'division_id' => 5,
            ],
            [
                'name' => 'Palo Seco',
                'division_id' => 8,
            ],
            [
                'name' => 'Paradise',
                'division_id' => 9,
            ],
            [
                'name' => 'Parlatuvier',
                'division_id' => 15,
            ],
            [
                'name' => 'Parrot Hall',
                'division_id' => 15,
            ],
            [
                'name' => 'Parry Lands',
                'division_id' => 8,
            ],
            [
                'name' => 'Parry Lands',
                'division_id' => 9,
            ],
            [
                'name' => 'Patience Hill',
                'division_id' => 15,
            ],
            [
                'name' => 'Pembroke',
                'division_id' => 15,
            ],
            [
                'name' => 'Penal',
                'division_id' => 4,
            ],

            [
                'name' => 'Penal Village',
                'division_id' => 4,
            ],

            [
                'name' => 'Pepper',
                'division_id' => 1,
            ],
            [
                'name' => 'Pepper Village',
                'division_id' => 1,
            ],
            [
                'name' => 'Peters',
                'division_id' => 6,
            ],
            [
                'name' => 'Petit Bourg',
                'division_id' => 2,
            ],
            [
                'name' => 'Petit Bourg',
                'division_id' => 7,
            ],
            [
                'name' => 'Petit Trou',
                'division_id' => 6,
            ],
            [
                'name' => 'Petit Valley',
                'division_id' => 2,
            ],
            [
                'name' => 'Phoenix Park',
                'division_id' => 1,
            ],
            [
                'name' => 'Piarco',
                'division_id' => 9,
            ],
            [
                'name' => 'Piarco Savanna Village',
                'division_id' => 9,
            ],
            [
                'name' => 'Pierreville',
                'division_id' => 3,
            ],
            [
                'name' => 'Piparo',
                'division_id' => 5,
            ],
            [
                'name' => 'Piparo Settlement',
                'division_id' => 5,
            ],
            [
                'name' => 'Plaisance',
                'division_id' => 3,
            ],
            [
                'name' => 'Plaisance',
                'division_id' => 4,
            ],
            [
                'name' => 'Plaisance Park',
                'division_id' => 5,
            ],
            [
                'name' => 'Platanal',
                'division_id' => 6,
            ],
            [
                'name' => 'Pleasantville',
                'division_id' => 14,
            ],
            [
                'name' => 'Pluck',
                'division_id' => 8,
            ],
            [
                'name' => 'Plum',
                'division_id' => 6,
            ],
            [
                'name' => 'Plum Mitan',
                'division_id' => 3,
            ],
            [
                'name' => 'Plum Mitan Settlement',
                'division_id' => 3,
            ],
            [
                'name' => 'Plymouth',
                'division_id' => 15,
            ],
            [
                'name' => 'Point Fortin',
                'division_id' => 12,
            ],
            [
                'name' => 'Point Ligoure',
                'division_id' => 12,
            ],
            [
                'name' => 'Pointe-a-Pierre',
                'division_id' => 1,
            ],
            [
                'name' => 'Poole',
                'division_id' => 3,
            ],
            [
                'name' => 'Port Louis',
                'division_id' => 15,
            ],
            [
                'name' => 'Port-of-Spain',
                'division_id' => 13,
            ],
            [
                'name' => 'Preau',
                'division_id' => 5,
            ],
            [
                'name' => 'Preysal',
                'division_id' => 1,
            ],
            [
                'name' => 'Princess Town',
                'division_id' => 5,
            ],
            [
                'name' => 'Prospect',
                'division_id' => 15,
            ],
            [
                'name' => 'Providence',
                'division_id' => 15,
            ],

            // ********************************************************************** Q -- Town Or City **************************************************************
            [
                'name' => 'Quarry Village',
                'division_id' => 8,
            ],

            // ********************************************************************** R -- Town Or City **************************************************************
            [
                'name' => 'Rambert',
                'division_id' => 4,
            ],
            [
                'name' => 'Rampanalgas',
                'division_id' => 6,
            ],
            [
                'name' => 'Ravin Anglais',
                'division_id' => 6,
            ],
            [
                'name' => 'Red Hill',
                'division_id' => 9,
            ],
            [
                'name' => 'Redhead',
                'division_id' => 6,
            ],
            [
                'name' => 'Reform',
                'division_id' => 5,
            ],
            [
                'name' => 'Riche Plaine',
                'division_id' => 2,
            ],
            [
                'name' => 'Richmond',
                'division_id' => 15,
            ],
            [
                'name' => 'Rio Claro',
                'division_id' => 3,
            ],
            [
                'name' => 'Riseland',
                'division_id' => 15,
            ],
            [
                'name' => 'Riversdale',
                'division_id' => 15,
            ],
            [
                'name' => 'Robert',
                'division_id' => 5,
            ],
            [
                'name' => 'Rockly Vale',
                'division_id' => 15,
            ],
            [
                'name' => 'Roselle',
                'division_id' => 15,
            ],
            [
                'name' => 'Roussillac',
                'division_id' => 8,
            ],
            [
                'name' => 'Roussillac Settlement',
                'division_id' => 8,
            ],
            [
                'name' => 'Roxborough',
                'division_id' => 15,
            ],
            [
                'name' => 'Roxborough Village',
                'division_id' => 15,
            ],
            [
                'name' => 'Runnemede',
                'division_id' => 15,
            ],
            [
                'name' => 'Runnymede',
                'division_id' => 15,
            ],
            [
                'name' => 'Rushville',
                'division_id' => 3,
            ],

            // ********************************************************************** R -- Town Or City **************************************************************

            [
                'name' => 'Sadhoowa',
                'division_id' => 4,
            ],
            [
                'name' => 'Saint Andrew',
                'division_id' => 1,
            ],
            [
                'name' => 'Saint Anns',
                'division_id' => 7,
            ],
            [
                'name' => 'Saint Augustine',
                'division_id' => 9,
            ],
            [
                'name' => 'Saint Clair',
                'division_id' => 13,
            ],
            [
                'name' => 'Saint Croix',
                'division_id' => 5,
            ],
            [
                'name' => 'Saint Elizabeth',
                'division_id' => 7,
            ],
            [
                'name' => 'Saint Helena',
                'division_id' => 9,
            ],
            [
                'name' => 'Saint James',
                'division_id' => 13,
            ],
            [
                'name' => 'Saint John',
                'division_id' => 5,
            ],
            [
                'name' => 'Saint Joseph',
                'division_id' => 3,
            ],
            [
                'name' => 'Saint Joseph',
                'division_id' => 9,
            ],
            [
                'name' => 'Saint Joseph',
                'division_id' => 14,
            ],
            [
                'name' => 'Saint Julien',
                'division_id' => 5,
            ],
            [
                'name' => 'Saint Madeleine',
                'division_id' => 5,
            ],
            [
                'name' => 'Saint Margaret',
                'division_id' => 1,
            ],
            [
                'name' => 'Saint Margaret',
                'division_id' => 3,
            ],
            [
                'name' => 'Saint Mary',
                'division_id' => 8,
            ],
            [
                'name' => 'Saint Marys',
                'division_id' => 1,
            ],
            [
                'name' => 'Saint Pierre',
                'division_id' => 2,
            ],
            [
                'name' => 'Saint Thomas',
                'division_id' => 11,
            ],
            [
                'name' => 'Sainte Croix',
                'division_id' => 5,
            ],
            [
                'name' => 'Sainte Madeleine',
                'division_id' => 5,
            ],
            [
                'name' => 'Salybia',
                'division_id' => 6,
            ],
            [
                'name' => 'San Fernando',
                'division_id' => 14,
            ],
            [
                'name' => 'San Francique',
                'division_id' => 8,
            ],
            [
                'name' => 'San Francisco Settlement',
                'division_id' => 1,
            ],
            [
                'name' => 'San Joachim',
                'division_id' => 9,
            ],
            [
                'name' => 'San José de Oruña',
                'division_id' => 9,
            ],
            [
                'name' => 'San Juan',
                'division_id' => 7,
            ],
            [
                'name' => 'San Rafael',
                'division_id' => 1,
            ],
            [
                'name' => 'Sangre Chiquita',
                'division_id' => 6,
            ],
            [
                'name' => 'Sangre Chiquito',
                'division_id' => 6,
            ],
            [
                'name' => 'Sangre Grande',
                'division_id' => 6,
            ],
            [
                'name' => 'Sans Souci',
                'division_id' => 6,
            ],
            [
                'name' => 'Santa Cruz',
                'division_id' => 7,
            ],
            [
                'name' => 'Scarborough',
                'division_id' => 15,
            ],
            [
                'name' => 'Sea View Gardens',
                'division_id' => 2,
            ],
            [
                'name' => 'Shirvan',
                'division_id' => 15,
            ],
            [
                'name' => 'Shore Park',
                'division_id' => 15,
            ],
            [
                'name' => 'Sierra Leone',
                'division_id' => 2,
            ],
            [
                'name' => 'Siparia',
                'division_id' => 8,
            ],
            [
                'name' => 'Sixth Company',
                'division_id' => 5,
            ],
            [
                'name' => 'Skarboras',
                'division_id' => 15,
            ],
            [
                'name' => 'Soledad',
                'division_id' => 1,
            ],
            [
                'name' => 'South Oropouche',
                'division_id' => 8,
            ],
            [
                'name' => 'Speyside',
                'division_id' => 15,
            ],

            [
                'name' => 'Speyside Village',
                'division_id' => 15,
            ],
            [
                'name' => 'Spring',
                'division_id' => 1,
            ],
            [
                'name' => 'Spring Vale',
                'division_id' => 1,
            ],
            [
                'name' => 'Spring Vale',
                'division_id' => 14,
            ],
            [
                'name' => 'Spring Village',
                'division_id' => 1,
            ],
            [
                'name' => 'Starwood',
                'division_id' => 15,
            ],
            [
                'name' => 'St Madeleine',
                'division_id' => 5,
            ],
            [
                'name' => 'Studley Park',
                'division_id' => 15,
            ],
            [
                'name' => 'Success',
                'division_id' => 7,
            ],
            [
                'name' => 'Sum Sum Hill',
                'division_id' => 1,
            ],
            //************************************************************ T - City or Town **********************************************************************
            [
                'name' => 'Tabaquite',
                'division_id' => 1,
            ],
            [
                'name' => 'Tableland',
                'division_id' => 5,
            ],
            [
                'name' => 'Tacarigua',
                'division_id' => 9,
            ],
            [
                'name' => 'Talparo',
                'division_id' => 1,
            ],
            [
                'name' => 'Tarouba',
                'division_id' => 5,
            ],
            [
                'name' => 'The Mission',
                'division_id' => 6,
            ],
            [
                'name' => 'The Whim',
                'division_id' => 15,
            ],
            [
                'name' => 'Thick',
                'division_id' => 8,
            ],
            [
                'name' => 'Third Company',
                'division_id' => 5,
            ],
            [
                'name' => 'Tierra Nueva',
                'division_id' => 9,
            ],
            [
                'name' => 'Toco',
                'division_id' => 6,
            ],
            [
                'name' => 'Todds Road',
                'division_id' => 1,
            ],
            [
                'name' => 'Tortuga',
                'division_id' => 1,
            ],
            [
                'name' => 'Town of Arima',
                'division_id' => 10,
            ],
            [
                'name' => 'Trafford',
                'division_id' => 9,
            ],
            [
                'name' => 'Trois Rivieres',
                'division_id' => 15,
            ],
            [
                'name' => 'Tulls',
                'division_id' => 9,
            ],
            [
                'name' => 'Tunapuna',
                'division_id' => 9,
            ],
            [
                'name' => 'Tyson Hall',
                'division_id' => 15,
            ],

            //************************************************************ U - City or Town **********************************************************************

            [
                'name' => 'Union',
                'division_id' => 14,
            ],
            [
                'name' => 'Union',
                'division_id' => 15,
            ],
            [
                'name' => 'Upper Carapichima',
                'division_id' => 1,
            ],
            [
                'name' => 'Upper Fishing Pond',
                'division_id' => 6,
            ],
            [
                'name' => 'Upper Manzanilla',
                'division_id' => 6,
            ],
            [
                'name' => 'Usine',
                'division_id' => 4,
            ],

            //************************************************************ V - City or Town **********************************************************************

            [
                'name' => 'Valencia',
                'division_id' => 6,
            ],
            [
                'name' => 'Valsayn',
                'division_id' => 9,
            ],
            [
                'name' => 'Vance River',
                'division_id' => 8,
            ],
            [
                'name' => 'Verdant Vale',
                'division_id' => 9,
            ],
            [
                'name' => 'Veronica',
                'division_id' => 9,
            ],
            [
                'name' => 'Vessigny',
                'division_id' => 8,
            ],
            [
                'name' => 'Victoria',
                'division_id' => 14,
            ],
            [
                'name' => 'Vista Bella',
                'division_id' => 14,
            ],

            //************************************************************ W - City or Town **********************************************************************
            [
                'name' => 'Warners',
                'division_id' => 7,
            ],
            [
                'name' => 'Waterloo',
                'division_id' => 1,
            ],
            [
                'name' => 'Williamsville',
                'division_id' => 5,
            ],
            [
                'name' => 'Williamsville Station',
                'division_id' => 5,
            ],
            [
                'name' => 'Windsor',
                'division_id' => 15,
            ],
            [
                'name' => 'Windsor Park',
                'division_id' => 1,
            ],
            [
                'name' => 'Woodbrook',
                'division_id' => 13,
            ],
            [
                'name' => 'Woodland',
                'division_id' => 8,
            ],
            [
                'name' => 'Woodlands',
                'division_id' => 5,
            ],
            [
                'name' => 'Woodlands',
                'division_id' => 15,
            ],
            [
                'name' => 'Wyaby',
                'division_id' => 1,
            ],

            //************************************************************ Z - City or Town **********************************************************************

            [
                'name' => 'Zion Hill',
                'division_id' => 15,
            ],
        ];

        foreach ($cities as $city) {
            if (isset($city['division_id']) && isset($city['name'])) {
                City::query()->create([
                    'division_id' => $city['division_id'],
                    'name' => $city['name'],
                ]);
            }
        }

    }
}
