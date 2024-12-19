<?php
use App\Models\Setting;
use App\Models\Platform;

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
        'service'=> [
            '1' => ['Prioritized', '<span class="badge bg-success">Prioritized</span>'],
            '2' => ['Active', '<span class="badge bg-primary">Active</span>'],
            '3' => ['Inactive', '<span class="badge bg-warning">Inactive</span>'],
        ],
        'bool'=> [
            '1' => ['Yes', '<span class="badge bg-primary">Yes</span>'],
            '2' => ['No', '<span class="badge bg-warning">No</span>']
        ],
        'visibility'=> [
            '1' => ['Public', '<span class="badge bg-success">Public</span>'],
            '2' => ['Private', '<span class="badge bg-warning">Private</span>'],
            '3' => ['Personal', '<span class="badge bg-danger">Personal</span>'],
        ],
        'user'=> [
            '1' => ['Active', '<span class="badge bg-success">Active</span>'],
            '2' => ['Problem', '<span class="badge bg-warning">Problem</span>'],
            '3' => ['Suspended', '<span class="badge bg-danger">Suspended</span>'],
        ],
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

function getPayment($prefix, $status = null, $type = null)
{
    $statuses = [
        'status'=> [
            '1' => ['Paid', '<span class="badge bg-success"> Paid</span>'],
            '2' => ['Partially Paid', '<span class="badge bg-primary"> Partially Paid</span>'],
            '3' => ['Pending', '<span class="badge bg-warning"> Pending</span>'],
            '4' => ['Unpaid', '<span class="badge bg-danger"> Unpaid</span>']
        ],
        'via'=> [
            '1' => ['Cash', '<span class="badge bg-primary">Cash</span>'],
            '2' => ['Check', '<span class="badge bg-danger">Check</span>'],
            '3' => ['Bank Transfer', '<span class="badge bg-info">Bank Transfer</span>'],
            '4' => ['Card', '<span class="badge bg-info">Card</span>'],
            '5' => ['Stripe', '<span class="badge bg-info">Stripe</span>'],
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

function getFields($prefix, $status = null, $type = null)
{
    $statuses = [
        'types'=> [
            '1' => ['text', '<span class="badge bg-primary">text</span>'],
            '2' => ['number', '<span class="badge bg-warning">number</span>'],
            '3' => ['phone', '<span class="badge bg-danger">phone</span>'],
            '4' => ['email', '<span class="badge bg-danger">email</span>'],
            '5' => ['textarea', '<span class="badge bg-danger">textarea</span>'],
        ],
    ];

    return statusReturn($prefix, $statuses, $status, $type );
}


// ************************* OTHERS ************************
function getFileTypeFromExtension($extension) {
    // Define arrays for different file types
    $imageExtensions = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
    $videoExtensions = ['mp4', 'avi', 'mov', 'mkv'];
    $documentExtensions = ['doc', 'docx', 'pdf', 'txt', 'xls', 'xlsx', 'ppt', 'pptx'];
    // Add more arrays as needed for other file types

    // Convert extension to lowercase for case-insensitive comparison
    $lowercaseExtension = strtolower($extension);

    // Check if the extension belongs to images
    if (in_array($lowercaseExtension, $imageExtensions)) {
        return '1'; // Return 'image' for images
    }
    // Check if the extension belongs to videos
    elseif (in_array($lowercaseExtension, $videoExtensions)) {
        return '2'; // Return 'video' for videos
    }
    // Check if the extension belongs to documents/files
    elseif (in_array($lowercaseExtension, $documentExtensions)) {
        return '3'; // Return 'document' for documents/files
    }
    else {
        return '0'; // Default type or handle other types as needed
    }
}

function getTax() {
    $tax = Setting::where('type', 'tax')->pluck('data')->first();
    return json_decode($tax)[0]->percentage;
}

function numberFormat($amount, $type=null) {
    $formatted = number_format($amount, 2, '.', ',');

    switch ($type) {
        case 'euro':
            return $formatted . '€';
        case 'percentage':
            return $formatted . '%';
        default:
            return $formatted;
    }
}


function getPlatforms() {
    return Platform::where('status', 1)->select('id', 'name')->orderBy('name')->get();
}
