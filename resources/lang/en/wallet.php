<?php

return [
    'tabs' => [
        'deposit' => 'Deposit',
        'withdraw' => 'Withdraw',
        'history' => 'History',
        'deposits' => 'Deposits',
        'withdraws' => 'Withdraws'
    ],
    'deposit' => [
        'address' => 'Your :currency deposit address',
        'minimumdepo' => 'Send only 1 deposit per address, address automatically refreshes after deposit. Min deposit: ',
        'confirmations' => ' '
        //'confirmations' => 'Only send :currency to this address, :confirmations confirmation(s) required.'
    ],
    'withdraw' => [
        'address' => '<i class=":icon"></i> :currency Address',
        'amount' => 'Amount (Min :min <i class=":icon"></i>)',
        'button' => 'Withdraw',
        'fee' => 'You need to have :fee <i class=":icon"></i> left on your account to cover the transaction fee.'
    ],
    'history' => [
        'empty' => 'You haven’t ordered anything yet.',
        'name' => 'Currency',
        'sum' => 'Amount',
        'date' => 'Date',
        'status' => 'Status',
        'confirmations' => 'Confirmations',
        'id' => 'ID: :id',
        'paid' => 'Successful',
        'wallet' => 'Address: :wallet',
        'cancel' => 'Cancel',
        'withdraw_cancelled' => 'Payment has been cancelled.',
        'withdraw_status' => [
            'moderation' => 'Pending',
            'accepted' => 'Successful',
            'declined' => 'Cancelled',
            'reason' => 'Reason:',
            'cancelled' => 'Cancelled by user'
        ]
    ],
    'copy' => 'Copy',
    'copied' => 'Copied!'
];
