<?php

function statement(array $invoice, array $plays)
{
    $totalAmount = 0;
    $volumeCredits = 0;
    $result = "Statement for {$invoice['customer']}\n";

    $format = new \NumberFormatter('en_US', NumberFormatter::CURRENCY);
    $format->setAttribute(\NumberFormatter::FRACTION_DIGITS, 2);

    foreach($invoice['performances'] as $perf){
        $play = $plays[$perf['playID']];
        $thisAmount = 0;

        switch ($play['type']){
            case 'tragedy':
                $thisAmount = 40000;
                if ($perf['audience'] > 30) {
                    $thisAmount += 1000 * ($perf['audience'] - 30);
                }
                break;
            case 'comedy':
                $thisAmount = 30000;
                if ($perf['audience'] > 30) {
                    $thisAmount += 10000 + 500 * ($perf['audience'] - 20);
                }
                $thisAmount += 300 * $perf['audience'];
                break;
            default:
                throw new Exception("unknown type: ${$play['type']}");
        }

        // soma créditos por volume
        $volumeCredits += max($perf['audience'] - 30, 0);
        // soma um crédito extra para cada dez espectadores de comédia
        if ('comedy' === $play['type']) $volumeCredits += floor($perf['audience'] / 5);
        // exibe a linha para esta requisição
        $result .= " {$play['name']}: ".$format->format($thisAmount / 100)." ({$perf['audience']} seats)\n";
        $totalAmount += $thisAmount;
    }

    $result .= "Amount owed is ".$format->format($totalAmount / 100)."\n";
    $result .= "You earned {$volumeCredits} credits\n";
    return $result;
}

$plays = [
    'hamlet' => [
        'name' => 'Hamlet',
        'type' => 'tragedy'
    ],
    'as-like' => [
        'name' => 'As You Like It',
        'type' => 'comedy'
    ],
    'othello' => [
        'name' => 'Othello',
        'type' => 'tragedy'
    ],
];

$invoices = [
    'customer' => 'BigCo',
    'performances' => [
        [
            'playID' => 'hamlet',
            'audience' => 55
        ],
        [
            'playID' => 'as-like',
            'audience' => 35
        ],
        [
            'playID' => 'othello',
            'audience' => 40
        ]
    ]
];

echo statement($invoices,$plays);
