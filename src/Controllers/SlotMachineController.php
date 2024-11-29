<?php
namespace App\Controllers;
class SlotMachineController
{
    public function show()
    {
        include_once __DIR__ . '/../Views/slotMachine.php';
    }
    
    public function play()
    {
        header('Content-Type: application/json');

        $symbols_with_weights = [
            '🍋' => 40,
            '🍒' => 30,
            '⭐' => 15,
            '🔔' => 10,
            '💎' => 5,
        ];

        $paytable = [
            '🍋🍋🍋' => 40,
            '🍒🍒🍒' => 50,
            '⭐⭐⭐' => 100,
            '🔔🔔🔔' => 150,
            '💎💎💎' => 200,
        ];

        $reel1 = $this->getRandomSymbol($symbols_with_weights);
        $reel2 = $this->getRandomSymbol($symbols_with_weights);
        $reel3 = $this->getRandomSymbol($symbols_with_weights);

        $combination = $reel1 . $reel2 . $reel3;
        $gain = $paytable[$combination] ?? 0;

        echo json_encode([
            'success' => true,
            'reels' => [$reel1, $reel2, $reel3],
            'gain' => $gain,
        ]);
    }
    private function getRandomSymbol($symbols_with_weights)
    {
        $rand = mt_rand(1, array_sum($symbols_with_weights));
        foreach ($symbols_with_weights as $symbol => $weight) {
            if ($rand <= $weight) {
                return $symbol;
            }
            $rand -= $weight;
        }
        return null;
    }
}
