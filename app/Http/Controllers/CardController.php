<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {
        return view('cards.index'); // Show the form
    }

    public function distributeCards(Request $request)
    {
        $validated = $request->validate([
            'people' => 'required|integer|min:1|max:53', // Validate input
        ]);

        $numPeople = $validated['people'];

        // Card deck initialization
        $cards = [];
        $suits = ['S', 'H', 'D', 'C'];
        $ranks = ['A', '2', '3', '4', '5', '6', '7', '8', '9', 'X', 'J', 'Q', 'K'];

        // Create the deck of cards
        foreach ($suits as $suit) {
            foreach ($ranks as $rank) {
                $cards[] = $suit . '-' . $rank;
            }
        }

        // Shuffle the deck
        shuffle($cards);

        // Distribute the cards to players
        $players = array_fill(0, $numPeople, []);

        $cardIndex = 0;
        while ($cardIndex < count($cards)) {
            foreach ($players as $key => $player) {
                if ($cardIndex < count($cards)) {
                    $players[$key][] = $cards[$cardIndex];
                    $cardIndex++;
                }
            }
        }

        // Return the distributed cards as a response
        return response()->json([
            'status' => 'success',
            'data' => $players
        ]);
    }
}
