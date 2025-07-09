<?php

return [
    // ----------------------------- Administrator Menu Permissions ----------------------------- //
    1 => [ 
        ['uri' => 'api/admin/users/admins', 'method' => 'GET'],
        ['uri' => 'api/admin/users/admins/search', 'method' => 'GET'],
        ['uri' => 'api/admin/users/admins/details', 'method' => 'GET'],
        ['uri' => 'admin/users/admins', 'method' => 'GET'],
        ['uri' => 'admin/users/admins/search', 'method' => 'GET'],
    ],
    2 => [
        ['uri' => 'api/admin/users/admins', 'method' => 'POST'],
    ],
    3 => [
        ['uri' => 'api/admin/users/admins/edit', 'method' => 'GET'],
        ['uri' => 'api/admin/users/admins', 'method' => 'PUT'],
    ],
    4 => [
        ['uri' => 'api/admin/users/admins/delete', 'method' => 'DELETE'],
    ],
    5 => [
        ['uri' => 'api/admin/permission/userpermissions', 'method' => 'GET'],
        ['uri' => 'api/admin/permission/userpermissions/search', 'method' => 'GET'],
        ['uri' => 'admin/permission/userpermissions', 'method' => 'GET'],
        ['uri' => 'admin/permission/userpermissions/search', 'method' => 'GET'],
    ],
    6 => [
        ['uri' => 'api/admin/permission/userpermissions/edit', 'method' => 'GET'],
        ['uri' => 'api/admin/permission/userpermissions', 'method' => 'PUT'],
        ['uri' => 'api/admin/permission/userpermissions/copy', 'method' => 'PUT'],
        ['uri' => 'api/admin/permission/userpermissions/from', 'method' => 'GET'],
        ['uri' => 'api/admin/permission/userpermissions/to', 'method' => 'GET'],
    ],
    7 => [
        ['uri' => 'api/admin/banks', 'method' => 'GET'],
        ['uri' => 'api/admin/banks/search', 'method' => 'GET'],
        ['uri' => 'api/admin/banks/details', 'method' => 'GET'],
        ['uri' => 'admin/banks', 'method' => 'GET'],
        ['uri' => 'admin/banks/search', 'method' => 'GET'],
    ],
    8 => [
        ['uri' => 'api/admin/locations', 'method' => 'GET'],
        ['uri' => 'api/admin/locations/search', 'method' => 'GET'],
        ['uri' => 'admin/locations', 'method' => 'GET'],
        ['uri' => 'admin/locations/search', 'method' => 'GET'],
    ],
    9 => [
        ['uri' => 'api/admin/stores', 'method' => 'GET'],
        ['uri' => 'api/admin/stores/search', 'method' => 'GET'],
        ['uri' => 'admin/stores', 'method' => 'GET'],
        ['uri' => 'admin/stores/search', 'method' => 'GET'],
    ],
    10 => [
        ['uri' => 'api/admin/stores', 'method' => 'POST'],
    ],
    11 => [
        ['uri' => 'api/admin/stores/edit', 'method' => 'GET'],
        ['uri' => 'api/admin/stores', 'method' => 'PUT'],
    ],
    12 => [
        ['uri' => 'api/admin/stores/delete', 'method' => 'DELETE'],
    ],





    // ----------------------------- General Transaction Menu Permissions ----------------------------- //
    // SETUP
    13 => [
        ['uri' => 'api/transaction/setup/groupes', 'method' => 'GET'],
        ['uri' => 'api/transaction/setup/groupes/search', 'method' => 'GET'],
        ['uri' => 'transaction/setup/groupes', 'method' => 'GET'],
        ['uri' => 'transaction/setup/groupes/search', 'method' => 'GET'],
    ],
    14 => [
        ['uri' => 'api/transaction/setup/groupes', 'method' => 'POST'],
    ],
    15 => [
        ['uri' => 'api/transaction/setup/groupes/edit', 'method' => 'GET'],
        ['uri' => 'api/transaction/setup/groupes', 'method' => 'PUT'],
    ],
    16 => [
        ['uri' => 'api/transaction/setup/groupes/delete', 'method' => 'DELETE'],
    ],
    17 => [
        ['uri' => 'api/transaction/setup/heads', 'method' => 'GET'],
        ['uri' => 'api/transaction/setup/heads/search', 'method' => 'GET'],
        ['uri' => 'transaction/setup/heads', 'method' => 'GET'],
        ['uri' => 'transaction/setup/heads/search', 'method' => 'GET'],
    ],
    18 => [
        ['uri' => 'api/transaction/setup/heads', 'method' => 'POST'],
    ],
    19 => [
        ['uri' => 'api/transaction/setup/heads/edit', 'method' => 'GET'],
        ['uri' => 'api/transaction/setup/heads', 'method' => 'PUT'],
    ],
    20 => [
        ['uri' => 'api/transaction/setup/heads/delete', 'method' => 'DELETE'],
    ],



    // USERS
    21 => [
        ['uri' => 'api/transaction/users/usertype', 'method' => 'GET'],
        ['uri' => 'api/transaction/users/usertype/search', 'method' => 'GET'],
        ['uri' => 'transaction/users/usertype', 'method' => 'GET'],
        ['uri' => 'transaction/users/usertype/search', 'method' => 'GET'],
    ],
    22 => [
        ['uri' => 'api/transaction/users/usertype', 'method' => 'POST'],
    ],
    23 => [
        ['uri' => 'api/transaction/users/usertype/edit', 'method' => 'GET'],
        ['uri' => 'api/transaction/users/usertype', 'method' => 'PUT'],
    ],
    24 => [
        ['uri' => 'api/transaction/users/usertype/delete', 'method' => 'DELETE'],
    ],
    25 => [
        ['uri' => 'api/transaction/users/clients', 'method' => 'GET'],
        ['uri' => 'api/transaction/users/clients/search', 'method' => 'GET'],
        ['uri' => 'api/transaction/users/clients/details', 'method' => 'GET'],
        ['uri' => 'transaction/users/clients', 'method' => 'GET'],
        ['uri' => 'transaction/users/clients/search', 'method' => 'GET'],
    ],
    26 => [
        ['uri' => 'api/transaction/users/clients', 'method' => 'POST'],
    ],
    27 => [
        ['uri' => 'api/transaction/users/clients/edit', 'method' => 'GET'],
        ['uri' => 'api/transaction/users/clients', 'method' => 'PUT'],
    ],
    28 => [
        ['uri' => 'api/transaction/users/clients/delete', 'method' => 'DELETE'],
    ],
    29 => [
        ['uri' => 'api/transaction/users/suppliers', 'method' => 'GET'],
        ['uri' => 'api/transaction/users/suppliers/search', 'method' => 'GET'],
        ['uri' => 'api/transaction/users/suppliers/details', 'method' => 'GET'],
        ['uri' => 'transaction/users/suppliers', 'method' => 'GET'],
        ['uri' => 'transaction/users/suppliers/search', 'method' => 'GET'],
    ],
    30 => [
        ['uri' => 'api/transaction/users/suppliers', 'method' => 'POST'],
    ],
    31 => [
        ['uri' => 'api/transaction/users/suppliers/edit', 'method' => 'GET'],
        ['uri' => 'api/transaction/users/suppliers', 'method' => 'PUT'],
    ],
    32 => [
        ['uri' => 'api/transaction/users/suppliers/delete', 'method' => 'DELETE'],
    ],




    // Transactions
    33 => [
        ['uri' => 'api/transaction/receive', 'method' => 'GET'],
        ['uri' => 'api/transaction/receive/search', 'method' => 'GET'],
        ['uri' => 'transaction/receive', 'method' => 'GET'],
        ['uri' => 'transaction/receive/search', 'method' => 'GET'],
    ],
    34 => [
        ['uri' => 'api/transaction/receive', 'method' => 'POST'],
    ],
    35 => [
        ['uri' => 'api/transaction/receive/edit', 'method' => 'GET'],
        ['uri' => 'api/transaction/receive', 'method' => 'PUT'],
    ],
    36 => [
        ['uri' => 'api/transaction/receive/delete', 'method' => 'DELETE'],
    ],
    37 => [
        ['uri' => 'api/transaction/payment', 'method' => 'GET'],
        ['uri' => 'api/transaction/payment/search', 'method' => 'GET'],
        ['uri' => 'transaction/payment', 'method' => 'GET'],
        ['uri' => 'transaction/payment/search', 'method' => 'GET'],
    ],
    38 => [
        ['uri' => 'api/transaction/payment', 'method' => 'POST'],
    ],
    39 => [
        ['uri' => 'api/transaction/payment/edit', 'method' => 'GET'],
        ['uri' => 'api/transaction/payment', 'method' => 'PUT'],
    ],
    40 => [
        ['uri' => 'api/transaction/payment/delete', 'method' => 'DELETE'],
    ],




    // Party Payment
    41 => [
        ['uri' => 'api/transaction/party/receive', 'method' => 'GET'],
        ['uri' => 'api/transaction/party/receive/search', 'method' => 'GET'],
        ['uri' => 'transaction/party/receive', 'method' => 'GET'],
        ['uri' => 'transaction/party/receive/search', 'method' => 'GET'],
    ],
    42 => [
        ['uri' => 'api/transaction/party/receive', 'method' => 'POST'],
    ],
    43 => [
        ['uri' => 'api/transaction/party/receive/edit', 'method' => 'GET'],
        ['uri' => 'api/transaction/party/receive', 'method' => 'PUT'],
    ],
    44 => [
        ['uri' => 'api/transaction/party/receive/delete', 'method' => 'DELETE'],
    ],
    45 => [
        ['uri' => 'api/transaction/party/payment', 'method' => 'GET'],
        ['uri' => 'api/transaction/party/payment/search', 'method' => 'GET'],
        ['uri' => 'transaction/party/payment', 'method' => 'GET'],
        ['uri' => 'transaction/party/payment/search', 'method' => 'GET'],
    ],
    46 => [
        ['uri' => 'api/transaction/party/payment', 'method' => 'POST'],
    ],
    47 => [
        ['uri' => 'api/transaction/party/payment/edit', 'method' => 'GET'],
        ['uri' => 'api/transaction/party/payment', 'method' => 'PUT'],
    ],
    48 => [
        ['uri' => 'api/transaction/party/payment/delete', 'method' => 'DELETE'],
    ],







    // ----------------------------- Bank Transaction Menu Permissions ----------------------------- //
    49 => [
        ['uri' => 'api/transaction/bank/deposit', 'method' => 'GET'],
        ['uri' => 'api/transaction/bank/deposit/search', 'method' => 'GET'],
        ['uri' => 'transaction/bank/deposit', 'method' => 'GET'],
        ['uri' => 'transaction/bank/deposit/search', 'method' => 'GET'],
    ],
    50 => [
        ['uri' => 'api/transaction/bank/deposit', 'method' => 'POST'],
    ],
    51 => [
        ['uri' => 'api/transaction/bank/deposit/edit', 'method' => 'GET'],
        ['uri' => 'api/transaction/bank/deposit', 'method' => 'PUT'],
    ],
    52 => [
        ['uri' => 'api/transaction/bank/deposit/delete', 'method' => 'DELETE'],
    ],
    53 => [
        ['uri' => 'api/transaction/bank/withdraw', 'method' => 'GET'],
        ['uri' => 'api/transaction/bank/withdraw/search', 'method' => 'GET'],
        ['uri' => 'transaction/bank/withdraw', 'method' => 'GET'],
        ['uri' => 'transaction/bank/withdraw/search', 'method' => 'GET'],
    ],
    54 => [
        ['uri' => 'api/transaction/bank/withdraw', 'method' => 'POST'],
    ],
    55 => [
        ['uri' => 'api/transaction/bank/withdraw/edit', 'method' => 'GET'],
        ['uri' => 'api/transaction/bank/withdraw', 'method' => 'PUT'],
    ],
    56 => [
        ['uri' => 'api/transaction/bank/withdraw/delete', 'method' => 'DELETE'],
    ],






    // ----------------------------- HR & Payroll Menu Permissions ----------------------------- //
    // SETUP
    57 => [
        ['uri' => 'api/hr/setup/departments', 'method' => 'GET'],
        ['uri' => 'api/hr/setup/departments/search', 'method' => 'GET'],
        ['uri' => 'hr/setup/departments', 'method' => 'GET'],
        ['uri' => 'hr/setup/departments/search', 'method' => 'GET'],
    ],
    58 => [
        ['uri' => 'api/hr/setup/departments', 'method' => 'POST'],
    ],
    59 => [
        ['uri' => 'api/hr/setup/departments/edit', 'method' => 'GET'],
        ['uri' => 'api/hr/setup/departments', 'method' => 'PUT'],
    ],
    60 => [
        ['uri' => 'api/hr/setup/departments/delete', 'method' => 'DELETE'],
    ],
    61 => [
        ['uri' => 'api/hr/setup/designations', 'method' => 'GET'],
        ['uri' => 'api/hr/setup/designations/search', 'method' => 'GET'],
        ['uri' => 'hr/setup/designations', 'method' => 'GET'],
        ['uri' => 'hr/setup/designations/search', 'method' => 'GET'],
    ],
    62 => [
        ['uri' => 'api/hr/setup/designations', 'method' => 'POST'],
    ],
    63 => [
        ['uri' => 'api/hr/setup/designations/edit', 'method' => 'GET'],
        ['uri' => 'api/hr/setup/designations', 'method' => 'PUT'],
    ],
    64 => [
        ['uri' => 'api/hr/setup/designations/delete', 'method' => 'DELETE'],
    ],




    // USERS / EMPLOYEE
    65 => [
        ['uri' => 'api/hr/employee/usertype', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/usertype/search', 'method' => 'GET'],
        ['uri' => 'hr/employee/usertype', 'method' => 'GET'],
        ['uri' => 'hr/employee/usertype/search', 'method' => 'GET'],
    ],
    66 => [
        ['uri' => 'api/hr/employee/usertype', 'method' => 'POST'],
    ],
    67 => [
        ['uri' => 'api/hr/employee/usertype/edit', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/usertype', 'method' => 'PUT'],
    ],
    68 => [
        ['uri' => 'api/hr/employee/usertype/delete', 'method' => 'DELETE'],
    ],
    69 => [
        ['uri' => 'api/hr/employee/all', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/all/search', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/all/details', 'method' => 'GET'],
        ['uri' => 'hr/employee/all', 'method' => 'GET'],
        ['uri' => 'hr/employee/all/search', 'method' => 'GET'],
    ],
    70 => [
        ['uri' => 'api/hr/employee/all', 'method' => 'POST'],
    ],
    71 => [
        ['uri' => 'api/hr/employee/all/edit', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/all', 'method' => 'PUT'],
    ],
    72 => [
        ['uri' => 'api/hr/employee/all/delete', 'method' => 'DELETE'],
    ],
    73 => [
        ['uri' => 'api/hr/employee/personal', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/personal/search', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/personal/details', 'method' => 'GET'],
        ['uri' => 'hr/employee/personal', 'method' => 'GET'],
        ['uri' => 'hr/employee/personal/search', 'method' => 'GET'],
    ],
    74 => [
        ['uri' => 'api/hr/employee/personal', 'method' => 'POST'],
    ],
    75 => [
        ['uri' => 'api/hr/employee/personal/edit', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/personal', 'method' => 'PUT'],
    ],
    76 => [
        ['uri' => 'api/hr/employee/personal/delete', 'method' => 'DELETE'],
    ],
    77 => [
        ['uri' => 'api/hr/employee/education', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/education/search', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/education/details', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/education/grid', 'method' => 'GET'],
        ['uri' => 'hr/employee/education', 'method' => 'GET'],
        ['uri' => 'hr/employee/education/search', 'method' => 'GET'],
    ],
    78 => [
        ['uri' => 'api/hr/employee/education', 'method' => 'POST'],
    ],
    79 => [
        ['uri' => 'api/hr/employee/education/edit', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/education', 'method' => 'PUT'],
    ],
    80 => [
        ['uri' => 'api/hr/employee/education/delete', 'method' => 'DELETE'],
    ],
    81 => [
        ['uri' => 'api/hr/employee/training', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/training/search', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/training/details', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/training/grid', 'method' => 'GET'],
        ['uri' => 'hr/employee/training', 'method' => 'GET'],
        ['uri' => 'hr/employee/training/search', 'method' => 'GET'],
    ],
    82 => [
        ['uri' => 'api/hr/employee/training', 'method' => 'POST'],
    ],
    83 => [
        ['uri' => 'api/hr/employee/training/edit', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/training', 'method' => 'PUT'],
    ],
    84 => [
        ['uri' => 'api/hr/employee/training/delete', 'method' => 'DELETE'],
    ],
    85 => [
        ['uri' => 'api/hr/employee/experience', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/experience/search', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/experience/details', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/experience/grid', 'method' => 'GET'],
        ['uri' => 'hr/employee/experience', 'method' => 'GET'],
        ['uri' => 'hr/employee/experience/search', 'method' => 'GET'],
    ],
    86 => [
        ['uri' => 'api/hr/employee/experience', 'method' => 'POST'],
    ],
    87 => [
        ['uri' => 'api/hr/employee/experience/edit', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/experience', 'method' => 'PUT'],
    ],
    88 => [
        ['uri' => 'api/hr/employee/experience/delete', 'method' => 'DELETE'],
    ],
    89 => [
        ['uri' => 'api/hr/employee/organization', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/organization/search', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/organization/details', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/organization/grid', 'method' => 'GET'],
        ['uri' => 'hr/employee/organization', 'method' => 'GET'],
        ['uri' => 'hr/employee/organization/search', 'method' => 'GET'],
    ],
    90 => [
        ['uri' => 'api/hr/employee/organization', 'method' => 'POST'],
    ],
    91 => [
        ['uri' => 'api/hr/employee/organization/edit', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/organization', 'method' => 'PUT'],
    ],
    92 => [
        ['uri' => 'api/hr/employee/organization/delete', 'method' => 'DELETE'],
    ],
    93 => [
        ['uri' => 'api/hr/employee/attendence', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/attendence/search', 'method' => 'GET'],
        ['uri' => 'hr/employee/attendence', 'method' => 'GET'],
        ['uri' => 'hr/employee/attendence/search', 'method' => 'GET'],
    ],
    94 => [
        ['uri' => 'api/hr/employee/attendence', 'method' => 'POST'],
    ],
    95 => [
        ['uri' => 'api/hr/employee/attendence/edit', 'method' => 'GET'],
        ['uri' => 'api/hr/employee/attendence', 'method' => 'PUT'],
    ],








    // Payroll / Transactions
    96 => [
        ['uri' => 'api/hr/payroll/heads', 'method' => 'GET'],
        ['uri' => 'api/hr/payroll/heads/search', 'method' => 'GET'],
        ['uri' => 'hr/payroll/heads', 'method' => 'GET'],
        ['uri' => 'hr/payroll/heads/search', 'method' => 'GET'],
    ],
    97 => [
        ['uri' => 'api/hr/payroll/heads', 'method' => 'POST'],
    ],
    98 => [
        ['uri' => 'api/hr/payroll/heads/edit', 'method' => 'GET'],
        ['uri' => 'api/hr/payroll/heads', 'method' => 'PUT'],
    ],
    99 => [
        ['uri' => 'api/hr/payroll/heads/delete', 'method' => 'DELETE'],
    ],
    100 => [
        ['uri' => 'api/hr/payroll/setup', 'method' => 'GET'],
        ['uri' => 'api/hr/payroll/setup/search', 'method' => 'GET'],
        ['uri' => 'hr/payroll/setup', 'method' => 'GET'],
        ['uri' => 'hr/payroll/setup/search', 'method' => 'GET'],
    ],
    101 => [ 
        ['uri' => 'api/hr/payroll/setup', 'method' => 'POST'],
    ],
    102 => [
        ['uri' => 'api/hr/payroll/setup/edit', 'method' => 'GET'],
        ['uri' => 'api/hr/payroll/setup', 'method' => 'PUT'],
    ],
    103 => [
        ['uri' => 'api/hr/payroll/setup/delete', 'method' => 'DELETE'],
    ],
    104 => [
        ['uri' => 'api/hr/payroll/middlewire', 'method' => 'GET'],
        ['uri' => 'api/hr/payroll/middlewire/search', 'method' => 'GET'],
        ['uri' => 'hr/payroll/middlewire', 'method' => 'GET'],
        ['uri' => 'hr/payroll/middlewire/search', 'method' => 'GET'],
    ],
    105 => [
        ['uri' => 'api/hr/payroll/middlewire', 'method' => 'POST'],
    ],
    106 => [
        ['uri' => 'api/hr/payroll/middlewire/edit', 'method' => 'GET'],
        ['uri' => 'api/hr/payroll/middlewire', 'method' => 'PUT'],
    ],
    107 => [
        ['uri' => 'api/hr/payroll/middlewire/delete', 'method' => 'DELETE'],
    ],
    108 => [
        ['uri' => 'api/hr/payroll/process', 'method' => 'GET'],
        ['uri' => 'api/hr/payroll/process/search', 'method' => 'GET'],
        ['uri' => 'hr/payroll/process', 'method' => 'GET'],
        ['uri' => 'hr/payroll/process/search', 'method' => 'GET'],
    ],
    109 => [
        ['uri' => 'api/hr/payroll/process', 'method' => 'POST'],
    ],
    110 => [
        ['uri' => 'api/hr/report/salary/summary', 'method' => 'GET'],
        ['uri' => 'api/hr/report/salary/summary/search', 'method' => 'GET'],
        ['uri' => 'hr/report/salary/summary', 'method' => 'GET'],
        ['uri' => 'hr/report/salary/summary/search', 'method' => 'GET'],
    ],
    111 => [
        ['uri' => 'api/hr/report/salary/details', 'method' => 'GET'],
        ['uri' => 'api/hr/report/salary/details/search', 'method' => 'GET'],
        ['uri' => 'hr/report/salary/details', 'method' => 'GET'],
        ['uri' => 'hr/report/salary/details/search', 'method' => 'GET'],
    ],







    // ----------------------------- Inventory Menu Permissions ----------------------------- //
    // SETUP
    194 => [
        ['uri' => 'api/inventory/setup/manufacturer', 'method' => 'GET'],
        ['uri' => 'api/inventory/setup/manufacturer/search', 'method' => 'GET'],
        ['uri' => 'inventory/setup/manufacturer', 'method' => 'GET'],
        ['uri' => 'inventory/setup/manufacturer/search', 'method' => 'GET'],
    ],
    195 => [
        ['uri' => 'api/inventory/setup/manufacturer', 'method' => 'POST'],
    ],
    196 => [
        ['uri' => 'api/inventory/setup/manufacturer/edit', 'method' => 'GET'],
        ['uri' => 'api/inventory/setup/manufacturer', 'method' => 'PUT'],
    ],
    197 => [
        ['uri' => 'api/inventory/setup/manufacturer/delete', 'method' => 'DELETE'],
    ],
    198 => [
        ['uri' => 'api/inventory/setup/category', 'method' => 'GET'],
        ['uri' => 'api/inventory/setup/category/search', 'method' => 'GET'],
        ['uri' => 'inventory/setup/category', 'method' => 'GET'],
        ['uri' => 'inventory/setup/category/search', 'method' => 'GET'],
    ],
    199 => [
        ['uri' => 'api/inventory/setup/category', 'method' => 'POST'],
    ],
    200 => [
        ['uri' => 'api/inventory/setup/category/edit', 'method' => 'GET'],
        ['uri' => 'api/inventory/setup/category', 'method' => 'PUT'],
    ],
    201 => [
        ['uri' => 'api/inventory/setup/category/delete', 'method' => 'DELETE'],
    ],
    202 => [
        ['uri' => 'api/inventory/setup/unit', 'method' => 'GET'],
        ['uri' => 'api/inventory/setup/unit/search', 'method' => 'GET'],
        ['uri' => 'inventory/setup/unit', 'method' => 'GET'],
        ['uri' => 'inventory/setup/unit/search', 'method' => 'GET'],
    ],
    203 => [
        ['uri' => 'api/inventory/setup/unit', 'method' => 'POST'],
    ],
    204 => [
        ['uri' => 'api/inventory/setup/unit/edit', 'method' => 'GET'],
        ['uri' => 'api/inventory/setup/unit', 'method' => 'PUT'],
    ],
    205 => [
        ['uri' => 'api/inventory/setup/unit/delete', 'method' => 'DELETE'],
    ],
    206 => [
        ['uri' => 'api/inventory/setup/form', 'method' => 'GET'],
        ['uri' => 'api/inventory/setup/form/search', 'method' => 'GET'],
        ['uri' => 'inventory/setup/form', 'method' => 'GET'],
        ['uri' => 'inventory/setup/form/search', 'method' => 'GET'],
    ],
    207 => [
        ['uri' => 'api/inventory/setup/form', 'method' => 'POST'],
    ],
    208 => [
        ['uri' => 'api/inventory/setup/form/edit', 'method' => 'GET'],
        ['uri' => 'api/inventory/setup/form', 'method' => 'PUT'],
    ],
    209 => [
        ['uri' => 'api/inventory/setup/form/delete', 'method' => 'DELETE'],
    ],
    210 => [
        ['uri' => 'api/inventory/setup/groupes', 'method' => 'GET'],
        ['uri' => 'api/inventory/setup/groupes/search', 'method' => 'GET'],
        ['uri' => 'inventory/setup/groupes', 'method' => 'GET'],
        ['uri' => 'inventory/setup/groupes/search', 'method' => 'GET'],
    ],
    211 => [
        ['uri' => 'api/inventory/setup/groupes', 'method' => 'POST'],
    ],
    212 => [
        ['uri' => 'api/inventory/setup/groupes/edit', 'method' => 'GET'],
        ['uri' => 'api/inventory/setup/groupes', 'method' => 'PUT'],
    ],
    213 => [
        ['uri' => 'api/inventory/setup/groupes/delete', 'method' => 'DELETE'],
    ],
    214 => [
        ['uri' => 'api/inventory/setup/product', 'method' => 'GET'],
        ['uri' => 'api/inventory/setup/product/search', 'method' => 'GET'],
        ['uri' => 'inventory/setup/product', 'method' => 'GET'],
        ['uri' => 'inventory/setup/product/search', 'method' => 'GET'],
    ],
    215 => [
        ['uri' => 'api/inventory/setup/product', 'method' => 'POST'],
    ],
    216 => [
        ['uri' => 'api/inventory/setup/product/edit', 'method' => 'GET'],
        ['uri' => 'api/inventory/setup/product', 'method' => 'PUT'],
    ],
    217 => [
        ['uri' => 'api/inventory/setup/product/delete', 'method' => 'DELETE'],
    ],






    // USERS
    218 => [
        ['uri' => 'api/inventory/users/usertype', 'method' => 'GET'],
        ['uri' => 'api/inventory/users/usertype/search', 'method' => 'GET'],
        ['uri' => 'inventory/users/usertype', 'method' => 'GET'],
        ['uri' => 'inventory/users/usertype/search', 'method' => 'GET'],
    ],
    219 => [
        ['uri' => 'api/inventory/users/usertype', 'method' => 'POST'],
    ],
    220 => [
        ['uri' => 'api/inventory/users/usertype/edit', 'method' => 'GET'],
        ['uri' => 'api/inventory/users/usertype', 'method' => 'PUT'],
    ],
    221 => [
        ['uri' => 'api/inventory/users/usertype/delete', 'method' => 'DELETE'],
    ],
    222 => [
        ['uri' => 'api/inventory/users/clients', 'method' => 'GET'],
        ['uri' => 'api/inventory/users/clients/search', 'method' => 'GET'],
        ['uri' => 'inventory/users/clients', 'method' => 'GET'],
        ['uri' => 'inventory/users/clients/search', 'method' => 'GET'],
    ],
    223 => [
        ['uri' => 'api/inventory/users/clients', 'method' => 'POST'],
    ],
    224 => [
        ['uri' => 'api/inventory/users/clients/edit', 'method' => 'GET'],
        ['uri' => 'api/inventory/users/clients', 'method' => 'PUT'],
    ],
    225 => [
        ['uri' => 'api/inventory/users/clients/delete', 'method' => 'DELETE'],
    ],
    226 => [
        ['uri' => 'api/inventory/users/suppliers', 'method' => 'GET'],
        ['uri' => 'api/inventory/users/suppliers/search', 'method' => 'GET'],
        ['uri' => 'inventory/users/suppliers', 'method' => 'GET'],
        ['uri' => 'inventory/users/suppliers/search', 'method' => 'GET'],
    ],
    227 => [
        ['uri' => 'api/inventory/users/suppliers', 'method' => 'POST'],
    ],
    228 => [
        ['uri' => 'api/inventory/users/suppliers/edit', 'method' => 'GET'],
        ['uri' => 'api/inventory/users/suppliers', 'method' => 'PUT'],
    ],
    229 => [
        ['uri' => 'api/inventory/users/suppliers/delete', 'method' => 'DELETE'],
    ],
    
    






    // Transactions
    230 => [
        ['uri' => 'api/inventory/transaction/purchase', 'method' => 'GET'],
        ['uri' => 'api/inventory/transaction/purchase/search', 'method' => 'GET'],
        ['uri' => 'inventory/transaction/purchase', 'method' => 'GET'],
        ['uri' => 'inventory/transaction/purchase/search', 'method' => 'GET'],
    ],
    231 => [
        ['uri' => 'api/inventory/transaction/purchase', 'method' => 'POST'],
    ],
    232 => [
        ['uri' => 'api/inventory/transaction/purchase/edit', 'method' => 'GET'],
        ['uri' => 'api/inventory/transaction/purchase', 'method' => 'PUT'],
    ],
    233 => [
        ['uri' => 'api/inventory/transaction/purchase/delete', 'method' => 'DELETE'],
    ],
    234 => [
        ['uri' => 'api/inventory/transaction/purchase/verify/delete', 'method' => 'DELETE'],
    ],
    235 => [
        ['uri' => 'api/inventory/transaction/issue', 'method' => 'GET'],
        ['uri' => 'api/inventory/transaction/issue/search', 'method' => 'GET'],
        ['uri' => 'inventory/transaction/issue', 'method' => 'GET'],
        ['uri' => 'inventory/transaction/issue/search', 'method' => 'GET'],
    ],
    236 => [
        ['uri' => 'api/inventory/transaction/issue', 'method' => 'POST'],
    ],
    237 => [
        ['uri' => 'api/inventory/transaction/issue/edit', 'method' => 'GET'],
        ['uri' => 'api/inventory/transaction/issue', 'method' => 'PUT'],
    ],
    238 => [
        ['uri' => 'api/inventory/transaction/issue/delete', 'method' => 'DELETE'],
    ],
    239 => [
        ['uri' => 'api/inventory/transaction/return/client', 'method' => 'GET'],
        ['uri' => 'api/inventory/transaction/return/client/search', 'method' => 'GET'],
        ['uri' => 'inventory/transaction/return/client', 'method' => 'GET'],
        ['uri' => 'inventory/transaction/return/client/search', 'method' => 'GET'],
    ],
    240 => [
        ['uri' => 'api/inventory/transaction/return/client', 'method' => 'POST'],
    ],
    241 => [
        ['uri' => 'api/inventory/transaction/return/client/edit', 'method' => 'GET'],
        ['uri' => 'api/inventory/transaction/return/client', 'method' => 'PUT'],
    ],
    242 => [
        ['uri' => 'api/inventory/transaction/return/client/delete', 'method' => 'DELETE'],
    ],
    243 => [
        ['uri' => 'api/inventory/transaction/return/supplier', 'method' => 'GET'],
        ['uri' => 'api/inventory/transaction/return/supplier/search', 'method' => 'GET'],
        ['uri' => 'inventory/transaction/return/supplier', 'method' => 'GET'],
        ['uri' => 'inventory/transaction/return/supplier/search', 'method' => 'GET'],
    ],
    244 => [
        ['uri' => 'api/inventory/transaction/return/supplier', 'method' => 'POST'],
    ],
    245 => [
        ['uri' => 'api/inventory/transaction/return/supplier/edit', 'method' => 'GET'],
        ['uri' => 'api/inventory/transaction/return/supplier', 'method' => 'PUT'],
    ],
    246 => [
        ['uri' => 'api/inventory/transaction/return/supplier/delete', 'method' => 'DELETE'],
    ],
    





    // ADJUSTMENT
    247 => [
        ['uri' => 'api/inventory/adjustment/positive', 'method' => 'GET'],
        ['uri' => 'api/inventory/adjustment/positive/search', 'method' => 'GET'],
        ['uri' => 'inventory/adjustment/positive', 'method' => 'GET'],
        ['uri' => 'inventory/adjustment/positive/search', 'method' => 'GET'],
    ],
    248 => [
        ['uri' => 'api/inventory/adjustment/positive', 'method' => 'POST'],
    ],
    249 => [
        ['uri' => 'api/inventory/adjustment/positive/edit', 'method' => 'GET'],
        ['uri' => 'api/inventory/adjustment/positive', 'method' => 'PUT'],
    ],
    250 => [
        ['uri' => 'api/inventory/adjustment/positive/delete', 'method' => 'DELETE'],
    ],
    251 => [
        ['uri' => 'api/inventory/adjustment/negative', 'method' => 'GET'],
        ['uri' => 'api/inventory/adjustment/negative/search', 'method' => 'GET'],
        ['uri' => 'inventory/adjustment/negative', 'method' => 'GET'],
        ['uri' => 'inventory/adjustment/negative/search', 'method' => 'GET'],
    ],
    252 => [
        ['uri' => 'api/inventory/adjustment/negative', 'method' => 'POST'],
    ],
    253 => [
        ['uri' => 'api/inventory/adjustment/negative/edit', 'method' => 'GET'],
        ['uri' => 'api/inventory/adjustment/negative', 'method' => 'PUT'],
    ],
    254 => [
        ['uri' => 'api/inventory/adjustment/negative/delete', 'method' => 'DELETE'],
    ],






    // PARTY PAYMENT
    255 => [
        ['uri' => 'api/inventory/party/receive', 'method' => 'GET'],
        ['uri' => 'api/inventory/party/receive/search', 'method' => 'GET'],
        ['uri' => 'inventory/party/receive', 'method' => 'GET'],
        ['uri' => 'inventory/party/receive/search', 'method' => 'GET'],
    ],
    256 => [
        ['uri' => 'api/inventory/party/receive', 'method' => 'POST'],
    ],
    257 => [
        ['uri' => 'api/inventory/party/receive/edit', 'method' => 'GET'],
        ['uri' => 'api/inventory/party/receive', 'method' => 'PUT'],
    ],
    258 => [
        ['uri' => 'api/inventory/party/receive/delete', 'method' => 'DELETE'],
    ],
    259 => [
        ['uri' => 'api/inventory/party/payment', 'method' => 'GET'],
        ['uri' => 'api/inventory/party/payment/search', 'method' => 'GET'],
        ['uri' => 'inventory/party/payment', 'method' => 'GET'],
        ['uri' => 'inventory/party/payment/search', 'method' => 'GET'],
    ],
    260 => [
        ['uri' => 'api/inventory/party/payment', 'method' => 'POST'],
    ],
    261 => [
        ['uri' => 'api/inventory/party/payment/edit', 'method' => 'GET'],
        ['uri' => 'api/inventory/party/payment', 'method' => 'PUT'],
    ],
    262 => [
        ['uri' => 'api/inventory/party/payment/delete', 'method' => 'DELETE'],
    ],
    






    // REPORTS
    263 => [
        ['uri' => 'api/inventory/report/item/flow', 'method' => 'GET'],
        ['uri' => 'api/inventory/report/item/flow/search', 'method' => 'GET'],
        ['uri' => 'inventory/report/item/flow', 'method' => 'GET'],
        ['uri' => 'inventory/report/item/flow/search', 'method' => 'GET'],
    ],
    264 => [
        ['uri' => 'api/inventory/report/stock/summary', 'method' => 'GET'],
        ['uri' => 'api/inventory/report/stock/summary/search', 'method' => 'GET'],
        ['uri' => 'inventory/report/stock/summary', 'method' => 'GET'],
        ['uri' => 'inventory/report/stock/summary/search', 'method' => 'GET'],
    ],
    265 => [
        ['uri' => 'api/inventory/report/stock/details', 'method' => 'GET'],
        ['uri' => 'api/inventory/report/stock/details/search', 'method' => 'GET'],
        ['uri' => 'inventory/report/stock/details', 'method' => 'GET'],
        ['uri' => 'inventory/report/stock/details/search', 'method' => 'GET'],
    ],
    266 => [
        ['uri' => 'api/inventory/report/profitability/statement', 'method' => 'GET'],
        ['uri' => 'api/inventory/report/profitability/statement/search', 'method' => 'GET'],
        ['uri' => 'inventory/report/profitability/statement', 'method' => 'GET'],
        ['uri' => 'inventory/report/profitability/statement/search', 'method' => 'GET'],
    ],
    267 => [
        ['uri' => 'api/inventory/report/expiry/statement', 'method' => 'GET'],
        ['uri' => 'api/inventory/report/expiry/statement/search', 'method' => 'GET'],
        ['uri' => 'inventory/report/expiry/statement', 'method' => 'GET'],
        ['uri' => 'inventory/report/expiry/statement/search', 'method' => 'GET'],
    ],
    268 => [
        ['uri' => 'api/inventory/report/purchase/summary', 'method' => 'GET'],
        ['uri' => 'api/inventory/report/purchase/summary/search', 'method' => 'GET'],
        ['uri' => 'inventory/report/purchase/summary', 'method' => 'GET'],
        ['uri' => 'inventory/report/purchase/summary/search', 'method' => 'GET'],
    ],
    269 => [
        ['uri' => 'api/inventory/report/purchase/details', 'method' => 'GET'],
        ['uri' => 'api/inventory/report/purchase/details/search', 'method' => 'GET'],
        ['uri' => 'inventory/report/purchase/details', 'method' => 'GET'],
        ['uri' => 'inventory/report/purchase/details/search', 'method' => 'GET'],
    ],
    270 => [
        ['uri' => 'api/inventory/report/issue/summary', 'method' => 'GET'],
        ['uri' => 'api/inventory/report/issue/summary/search', 'method' => 'GET'],
        ['uri' => 'inventory/report/issue/summary', 'method' => 'GET'],
        ['uri' => 'inventory/report/issue/summary/search', 'method' => 'GET'],
    ],
    271 => [
        ['uri' => 'api/inventory/report/issue/details', 'method' => 'GET'],
        ['uri' => 'api/inventory/report/issue/details/search', 'method' => 'GET'],
        ['uri' => 'inventory/report/issue/details', 'method' => 'GET'],
        ['uri' => 'inventory/report/issue/details/search', 'method' => 'GET'],
    ],
    272 => [
        ['uri' => 'api/inventory/report/return/client/summary', 'method' => 'GET'],
        ['uri' => 'api/inventory/report/return/client/summary/search', 'method' => 'GET'],
        ['uri' => 'inventory/report/return/client/summary', 'method' => 'GET'],
        ['uri' => 'inventory/report/return/client/summary/search', 'method' => 'GET'],
    ],
    273 => [
        ['uri' => 'api/inventory/report/return/client/details', 'method' => 'GET'],
        ['uri' => 'api/inventory/report/return/client/details/search', 'method' => 'GET'],
        ['uri' => 'inventory/report/return/client/details', 'method' => 'GET'],
        ['uri' => 'inventory/report/return/client/details/search', 'method' => 'GET'],
    ],
    274 => [
        ['uri' => 'api/inventory/report/return/supplier/summary', 'method' => 'GET'],
        ['uri' => 'api/inventory/report/return/supplier/summary/search', 'method' => 'GET'],
        ['uri' => 'inventory/report/return/supplier/summary', 'method' => 'GET'],
        ['uri' => 'inventory/report/return/supplier/summary/search', 'method' => 'GET'],
    ],
    275 => [
        ['uri' => 'api/inventory/report/return/supplier/details', 'method' => 'GET'],
        ['uri' => 'api/inventory/report/return/supplier/details/search', 'method' => 'GET'],
        ['uri' => 'inventory/report/return/supplier/details', 'method' => 'GET'],
        ['uri' => 'inventory/report/return/supplier/details/search', 'method' => 'GET'],
    ],








    // ----------------------------- Reports & Queries Menu Permissions ----------------------------- //
    276 => [
        ['uri' => 'api/report/account/summary', 'method' => 'GET'],
        ['uri' => 'api/report/account/summary/search', 'method' => 'GET'],
        ['uri' => 'report/account/summary', 'method' => 'GET'],
        ['uri' => 'report/account/summary/search', 'method' => 'GET'],
    ],
    277 => [
        ['uri' => 'api/report/account/summarygroupe', 'method' => 'GET'],
        ['uri' => 'api/report/account/summarygroupe/search', 'method' => 'GET'],
        ['uri' => 'report/account/summarygroupe', 'method' => 'GET'],
        ['uri' => 'report/account/summarygroupe/search', 'method' => 'GET'],
    ],
    278 => [
        ['uri' => 'api/report/account/details', 'method' => 'GET'],
        ['uri' => 'api/report/account/details/search', 'method' => 'GET'],
        ['uri' => 'report/account/details', 'method' => 'GET'],
        ['uri' => 'report/account/details/search', 'method' => 'GET'],
    ],
    279 => [
        ['uri' => 'api/report/party/summary', 'method' => 'GET'],
        ['uri' => 'api/report/party/summary/search', 'method' => 'GET'],
        ['uri' => 'report/party/summary', 'method' => 'GET'],
        ['uri' => 'report/party/summary/search', 'method' => 'GET'],
    ],
    280 => [
        ['uri' => 'api/report/party/details', 'method' => 'GET'],
        ['uri' => 'api/report/party/details/search', 'method' => 'GET'],
        ['uri' => 'report/party/details', 'method' => 'GET'],
        ['uri' => 'report/party/details/search', 'method' => 'GET'],
    ],
    













    281 => [
        ['uri' => 'api/admin/locations', 'method' => 'POST'],
    ],
    282 => [
        ['uri' => 'api/admin/locations/edit', 'method' => 'GET'],
        ['uri' => 'api/admin/locations', 'method' => 'PUT'],
    ],
    283 => [
        ['uri' => 'api/admin/locations/delete', 'method' => 'DELETE'],
    ],


    284 => [
        ['uri' => 'api/admin/banks', 'method' => 'POST'],
    ],
    285 => [
        ['uri' => 'api/admin/banks/edit', 'method' => 'GET'],
        ['uri' => 'api/admin/banks', 'method' => 'PUT'],
    ],
    286 => [
        ['uri' => 'api/admin/banks/delete', 'method' => 'DELETE'],
    ],
    
    
    287 => [ 
        ['uri' => 'api/admin/payment_method', 'method' => 'GET'],
        ['uri' => 'api/admin/payment_method/search', 'method' => 'GET'],
        ['uri' => 'api/admin/payment_method/details', 'method' => 'GET'],
        ['uri' => 'admin/payment_method', 'method' => 'GET'],
        ['uri' => 'admin/payment_method/search', 'method' => 'GET'],
    ],
    288 => [
        ['uri' => 'api/admin/payment_method', 'method' => 'POST'],
    ],
    289 => [
        ['uri' => 'api/admin/payment_method/edit', 'method' => 'GET'],
        ['uri' => 'api/admin/payment_method', 'method' => 'PUT'],
    ],
    290 => [
        ['uri' => 'api/admin/payment_method/delete', 'method' => 'DELETE'],
    ],
    
    
    291 => [ 
        ['uri' => 'api/admin/corporate', 'method' => 'GET'],
        ['uri' => 'api/admin/corporate/search', 'method' => 'GET'],
        ['uri' => 'api/admin/corporate/details', 'method' => 'GET'],
        ['uri' => 'admin/corporate', 'method' => 'GET'],
        ['uri' => 'admin/corporate/search', 'method' => 'GET'],
    ],
    292 => [
        ['uri' => 'api/admin/corporate', 'method' => 'POST'],
    ],
    293 => [
        ['uri' => 'api/admin/corporate/edit', 'method' => 'GET'],
        ['uri' => 'api/admin/corporate', 'method' => 'PUT'],
    ],
    294 => [
        ['uri' => 'api/admin/corporate/delete', 'method' => 'DELETE'],
    ],
    
];