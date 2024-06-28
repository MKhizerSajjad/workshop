<?php
function statusReturn($prefix, $statuses, $status = null, $type = null)
{
    if(isset($statuses[$prefix])) {
        $statusArray = $statuses[$prefix];

        return isset($statusArray[$status])
            ? ($type === 'badge' ? $statusArray[$status][1] : $statusArray[$status][0])
            : ($type === 'badge' ? array_column($statusArray, 1) : array_column($statusArray, 0));

    } else {
        return 'Unknown'; // Or handle the case when $prefix is not found in $statuses
    }
}

function getGenStatus($prefix, $status = null, $type = null)
{
    $statuses = [
        'general'=> [
            '1' => ['Active', '<span class="badge bg-primary">Active</span>'],
            '2' => ['Inactive', '<span class="badge bg-warning">Inactive</span>']
        ],
        'bool'=> [
            '1' => ['Yes', '<span class="badge bg-primary">Yes</span>'],
            '2' => ['No', '<span class="badge bg-warning">No</span>']
        ]
    ];

    return statusReturn($prefix, $statuses, $status, $type );
}


function getStockStatus($prefix, $status = null, $type = null)
{
    $statuses = [
        'general'=> [
            '1' => ['In Stock', '<span class="badge bg-primary">In Stock</span>'],
            '2' => ['Low stock', '<span class="badge bg-warning">Low stock</span>'],
            '3' => ['Out of Stock', '<span class="badge bg-danger">Out of Stock</span>'],
            '4' => ['Reordered', '<span class="badge bg-info">Reordered</span>']
        ],
        'woocommerce'=> [
            'instock' => ['Instock', '<span class="badge bg-primary">Instock</span>'],
            'outofstock' => ['Out of Stock', '<span class="badge bg-danger">Out of Stock</span>'],
            'onbackorder' => ['On Back Order', '<span class="badge bg-info">On Back Order</span>'],
        ]
    ];

    return statusReturn($prefix, $statuses, $status, $type );
}
