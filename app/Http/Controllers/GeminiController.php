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
    }

    public function callGeminiFlash(string $prompt): ?array
    {
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . urlencode($this->apiKey);

        $data = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $prompt,
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

        return $decodedResult;
    }

    public function generateContent($prompt)
    {
        $prompt = 'Hey'; // You can change this to get from request if needed
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

        $items = ImageModel::all();
        dd($items);



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
        // $item = ImageModel::create(
        //     [
        //         'category' => 'ZZZ', 'images' => json_encode(['image1.jpg', 'image2.jpg']), 'image' => 'main_image.jpg'
        //     ]
        // );
        $item = ImageModel::all();
    }
}