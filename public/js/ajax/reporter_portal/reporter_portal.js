function ShowReporterPortal(res) {
    tableInstance = new GenerateTable({
        tableId: "#data-table",
        data: res.data,
        tbody: [
            "tran_id",
            "head.tran_head_name",
            "store.store_name",
            "quantity",
            { key: "tran_date", type: "date" },
        ],

        actions: (row) => {
            let buttons = "";

            if (userPermissions.includes(253) || role == 1) {
                buttons += `
                    <button data-modal-id="editModal" id="edit" data-id="${row.id}"><i class="fas fa-edit"></i></button>
                `;
            }

            if (userPermissions.includes(254) || role == 1) {
                buttons += `
                <button data-id="${row.id}" id="delete_status" class="icon-wrapper" title="Toggle Delete"><i class="fa-solid fa-trash-arrow-up main-icon"></i><i class="fa-solid fa-arrows-rotate ring-icon"></i></button>
                `;

                if (role == 1 || role == 2) {
                    buttons += `
                        <button data-id="${row.id}" id="delete"><i class="fas fa-trash"></i></button>
                    `;
                }
            }

            return buttons;
        },
    });
}

$(document).ready(function () {
    // Render The Table Heads
    renderTableHead([
        { label: "SL:", type: "rowsPerPage", options: [15, 30, 50, 100, 500] },
        { label: " User Id", key: "tran_id" },
        { label: "Title", key: "head.tran_head_name" },
        { label: "Description", key: "store.store_name" },
        { label: "Upload file" },
        { label: "Action", type: "button" },
    ]);

    // Load Transaction Groupe
    GetTransactionGroupe(5);

    // Load Data on Hard Reload
    ReloadData("reporter", ShowReporterPortal);

    // Add Modal Open Functionality
    AddModalFunctionality("#store");

    // Insert Ajax
    InsertAjax(
        "inventory/adjustment/negative",
        {
            product: { selector: "#product", attribute: "data-id" },
            groupe: { selector: "#product", attribute: "data-groupe" },
            company: { selector: "#company", attribute: "data-id" },
            method: "Negative",
            type: 5,
        },
        function () {
            $("#store").focus();
            $("#store").val("");
            $("#store").removeAttr("data-id");
            $("#product").val("");
            $("#product").removeAttr("data-id");
            $("#product").removeAttr("data-groupe");
            $("#quantity").val("1");
        }
    );

    //Edit Ajax
    EditAjax(EditFormInputValue);

    // Update Ajax
    UpdateAjax(
        "inventory/adjustment/negative",
        {
            product: { selector: "#updateProduct", attribute: "data-id" },
            groupe: { selector: "#updateProduct", attribute: "data-groupe" },
            method: "Negative",
            type: 5,
        },
        function () {
            $("#updateProduct").val("");
            $("#updateProduct").removeAttr("data-id");
            $("#updateProduct").removeAttr("data-groupe");
            $("#updateQuantity").val("1");
        }
    );

    // Delete Ajax
    DeleteAjax("inventory/adjustment/negative");

    // Delete status bAjax
    DeleteStatusAjax("inventory/adjustment/negative");

    // Search By Date Ajax
    SearchByDateAjax(
        "inventory/adjustment/negative/seaarch",
        ShowInventoryNegativeAdjustments,
        { type: 5, method: "Negative" }
    );

    // Additional Edit Functionality
    function EditFormInputValue(item) {
        $("#id").val(item.id);
        $("#updateTranId").val(item.tran_id);
        $("#updateStore").val(item.store_id);
        $("#updateProduct").attr("data-groupe", item.tran_groupe_id);
        $("#updateProduct").attr("data-id", item.tran_head_id);
        $("#updateProduct").val(item.head.tran_head_name);
        $("#updateQuantity").val(item.quantity);
        $("#updateCp").val(item.cp);
        $("#updateMrp").val(item.mrp);
    }

    // Get Store
    GetSelectInputList("admin/stores/get", function (res) {
        CreateSelectOptions("#store", "Select Store", res.data, "store_name");
        CreateSelectOptions(
            "#updateStore",
            "Select Store",
            res.data,
            "store_name"
        );
    });
});
