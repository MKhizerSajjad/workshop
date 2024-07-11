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

function getUsertype($prefix, $status = null, $type = null)
{
    $statuses = [
        'all'=> [
            '1' => ['Admin', '<span class="badge bg-info">Admin</span>'],
            '2' => ['Manager', '<span class="badge bg-warning">Manager</span>'],
            '3' => ['Technician', '<span class="badge bg-secondary">Technician</span>'],
            '4' => ['Customer', '<span class="badge bg-success">Customer</span>']
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

function getCaseStatus($prefix, $status = null, $type = null)
{
    $statuses = [
        'general'=> [
            '1' => ['To Recieve', '<span class="badge bg-primary">To Recieve</span>'],
            '2' => ['Recieved', '<span class="badge bg-warning">Recieved</span>'],
            '3' => ['Inspecting', '<span class="badge bg-danger">Inspecting</span>'],
            '4' => ['Update Faults', '<span class="badge bg-info">Update Faults</span>'],
            '5' => ['Work In Progress', '<span class="badge bg-info">Work In Progress</span>'],
            '6' => ['Completed', '<span class="badge bg-info">Completed</span>'],
            '7' => ['Ready To Dispatch', '<span class="badge bg-info">Ready To Dispatch</span>'],
            '8' => ['Dispatched', '<span class="badge bg-info">Dispatched</span>'],
            '9' => ['Delivered', '<span class="badge bg-info">Delivered</span>'],
        ],
        'woocommerce'=> [
            'instock' => ['Instock', '<span class="badge bg-primary">Instock</span>'],
            'outofstock' => ['Out of Stock', '<span class="badge bg-danger">Out of Stock</span>'],
            'onbackorder' => ['On Back Order', '<span class="badge bg-info">On Back Order</span>'],
        ]
    ];

    return statusReturn($prefix, $statuses, $status, $type );
}

function getService($prefix, $status = null, $type = null)
{
    $statuses = [
        'location'=> [
            '1' => ['Deliver to office', '<span class="badge bg-primary">Deliver to office</span>'],
            '2' => ['I will send to office', '<span class="badge bg-warning">I will send to office</span>'],
            '3' => ['Invite engineer to my home', '<span class="badge bg-danger">Invite engineer to my home</span>'],
        ],
    ];

    return statusReturn($prefix, $statuses, $status, $type );
}


// ************************* OTHERS ************************
function getFileTypeFromExtension($extension) {
    $imageExtensions = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
    $videoExtensions = ['mp4', 'avi', 'mov', 'mkv'];

    if (in_array(strtolower($extension), $imageExtensions)) {
        return '1';
    } elseif (in_array(strtolower($extension), $videoExtensions)) {
        return '2';
    } else {
        return '3'; // Default type or handle other types as needed
    }
}
