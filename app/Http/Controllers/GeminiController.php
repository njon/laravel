<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\ImageModel;

class GeminiController extends Controller
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = 'AIzaSyAOy35O_6G9FGfbJJr8H09EAJHP-7Fv8EE';
        $this->promptGuide = 'write midjourney prompt. it should be professional photography, its commercial photography ( dont comment, output only prompt ), for this word/phrase:';
    }

    public function callGeminiFlash(string $prompt = 'beach')
    {
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . urlencode($this->apiKey);

        $data = [
            'contents' => [
                [
                    'parts' => [
                        [
                            // 'text' => $this->promptGuide . ' ' . $prompt,

                            'text' => 'write midjourney prompt for :' . $prompt . '. Output only 1 prompt and dont add comments'
                        ],
                    ],
                ],
            ],
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ],
        ];

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === false) {
            return null;
        }

        $decodedResult = json_decode($result, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }

        $textValue = $decodedResult['candidates'][0]['content']['parts'][0]['text'];

        return $textValue;
    }

    public function generateContent($prompt)
    {
        $result = $this->callGeminiFlash($prompt);

        if ($result !== null) {
            try {
                $generatedText = $result['candidates'][0]['content']['parts'][0]['text'];
                return response()->json(['text' => $generatedText]);
            } catch (\Exception $e) {
                Log::error('Error parsing response: ' . $e->getMessage());
                return response()->json(['error' => 'Error parsing response.'], 500);
            }
        } else {
            return response()->json(['error' => 'Failed to call Gemini Flash API.'], 500);
        }
    }

    public function genImage($prompt = 'test image')  {
        $data = [
            'prompt' => $prompt
        ];
         
        $url = 'https://cl.imagineapi.dev/items/images/';
         
        $headers = [
            "Authorization: Bearer imgn_53fssil4eduda4y67m5wlwi2rfjirey6", # <<<< TODO change the API key here
            "Content-Type: application/json"
        ];
         
         
        $options = [
            'http' => [
                'method' => 'POST',
                'header' => join("\r\n", $headers),
                'content' => json_encode($data)
            ]
        ];
         
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $responseData = json_decode($response, true);
         
         
        // Initial response
        echo json_encode($responseData, JSON_UNESCAPED_SLASHES) . "\n";
         
         
        // Polling for completion
        while (true) {
            sleep(5); // Wait for 5 seconds
         
            $imageId = $responseData['data']['id'];
            $url = 'https://cl.imagineapi.dev/items/images/' . $imageId;
         
            $options = [
                'http' => [
                    'method' => 'GET',
                    'header' => join("\r\n", $headers),
                ]
            ];
         
            $innerContext = stream_context_create($options);
         
            $response = file_get_contents($url, false, $innerContext);
            $checkData = json_decode($response, true);
         
            if ($checkData['data']['status'] === 'completed' || $checkData['data']['status'] === 'failed') {
                // Stop when the image is completed or failed
                dd($checkData);
                break;
            } else {
                echo "Image is not finished generation. Status: " . $checkData['data']['status'] . "\n";
            }
            // TODO: add a check to ensure this does not run indefinitely
        }
    }

    public function store()
    {
        $flattenedCategories = [
            'Holistic Therapies',
        ];

        $prompt = $this->callGeminiFlash($flattenedCategories[0]);

        $this->genImage($prompt);


        // $item = ImageModel::all();

        $flattenedCategories = [
            'Valentine\'s Gifts for Him',
            'Valentine\'s Gifts for Her',
            'Couple\'s Valentine Packages',
            'Vacation in Athens',
            'Vacation in Santorini',
            'Wellness Retreats',
            'Vacation in Crete',
            'Seaside Getaways',
            'Luxury SPA Resorts',
            'Lakeside Escapes',
            'Vacation in Rhodes',
            'City Breaks in Thessaloniki',
            'Workation Packages',
            'Vacation in Corfu',
            'Solo Retreats',
            'Romantic Getaways for Two',
            'Historical Castle Stays',
            'Couples SPA Packages',
            'Facial Treatments',
            'Relaxation Massages',
            'Men\'s Therapies',
            'Lymphatic Drainage',
            'Traditional Greek Therapies',
            'Ayurvedic Massages',
            'Prenatal Massages',
            'Medical Massages',
            'Full-Body Treatments',
            'SPA Rituals',
            'Back & Neck Massages',
            'Scalp Treatments',
            'Massage Bundles',
            'Fine Dining Experiences',
            'Greek Food Tastings',
            'Cooking Classes',
            'Gourmet Home Delivery',
            'Wine & Olive Oil Tastings',
            'Restaurant Vouchers',
            'Artisan Desserts',
            'International Cuisine Nights',
            'Brunch Specials',
            'Hot Air Balloon Rides',
            'Skydiving',
            'Paragliding',
            'Gliding Flights',
            'Scenic Helicopter Tours',
            'Flight Lessons',
            'Cinema Nights',
            'Online Workshops',
            'Cultural Tours',
            'Art & Craft Classes',
            'Photoshoot Sessions',
            'Perfume Crafting',
            'Theater & Concerts',
            'Museum Passes',
            'Dance/Music Lessons',
            'Bookstore Gift Cards',
            'Online Shopping Vouchers',
            'Magazine Subscriptions',
            'Go-Karting',
            'Drifting Experiences',
            'Driving Lessons',
            'ATV Adventures',
            'Tank Rides',
            'Monster Truck Rallies',
            'Motorcycle Tours',
            'Quad Biking',
            'Jeep Safaris',
            'Bike & Scooter Rentals',
            'Supercar Test Drives',
            'Convertible Cruises',
            'Custom Packages',
            'Escape Rooms',
            'Bowling',
            'Shooting Ranges',
            'Rock Climbing',
            'Horseback Riding',
            'Martial Arts Sessions',
            'Theme Park Tickets',
            'Paintball',
            'Laser Tag',
            'Golf Packages',
            'Board Game Cafés',
            'Hiking Trips',
            'VR Experiences',
            'Porsche Rides',
            'Lamborghini Drives',
            'Ferrari Tours',
            'Tesla Experiences',
            'Water Parks',
            'Pool & Sauna Access',
            'Fishing Trips',
            'Scuba Diving',
            'Sailing & Yacht Charters',
            'Flyboarding',
            'Jet Skiing',
            'Water Trampolines',
            'Kayaking',
            'Paddleboarding',
            'Surfing Lessons',
            'Boat & Water Bike Rentals',
            'Other Water Activities',
            'Skincare Treatments',
            'Beauty Packages',
            'Manicure & Pedicure',
            'Men\'s Grooming',
            'Health Checkups',
            'Professional Makeup',
            'Hair Treatments',
            'Body Sculpting',
            'Beauty Workshops',
            'Teeth Whitening',
            'Vacation in Italy',
            'Vacation in Turkey',
            'Vacation in Cyprus',
            'Other Destinations',
            'Blood Tests',
            'Dental Care',
            'Detox Programs',
            'Float Therapy',
            'Yoga & Meditation Retreats',
            'Holistic Therapies',
        ];
        
    }
}