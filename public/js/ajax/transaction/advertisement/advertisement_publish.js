function ShowAdvertisementInfo(res) {
    tableInstance = new GenerateTable({
        tableId: "#data-table",
        data: res.data,
        tbody: [
            "publication_date",
            "client_id",
            "title",
            "caption",
            "category",
            "page_no",
            "column_inch",
            "",
        ],

        actions: (row) => {
            let buttons = "";

            buttons += `
                <button class="open-modal" data-modal-id="detailsModal" id="details" data-id="${row.user_id}"><i class="fa-solid fa-circle-info"></i></button>
            `;

            if (userPermissions.includes(27) || role == 1) {
                buttons += `
                    <button data-modal-id="editModal" id="edit" data-id="${row.id}"><i class="fas fa-edit"></i></button>
                `;
            }

            if (userPermissions.includes(28) || role == 1) {
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
        { label: " Publication Date", key: "added_at" },
        { label: " Client id", key: "tran_id" },
        { label: "Title", key: "head.tran_head_name" },
        { label: "Caption", key: "head.tran_head_name" },
        { label: "Category", key: "head.tran_head_name" },
        { label: "Page NO", key: "store.store_name" },
        { label: "Column Inch", key: "store.store_name" },

        { label: "Action", type: "button" },
    ]);

    GetTransactionWith("2", "Receive", "#within");

    // Load Transaction Groupe
    GetTransactionGroupe(5);

    // Load Data on Hard Reload
    ReloadData("advertise/publish", ShowAdvertisementInfo);

    // Add Modal Open Functionality
    AddModalFunctionality("#store");

    // Insert Ajax
    InsertAjax("advertise/publish", {
        user: { selector: "#user", attribute: "data-id" },
    });

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
    DeleteAjax("advertise/publish");

    // Delete status bAjax
    DeleteStatusAjax("advertise/publish/");

    // Search By Date Ajax
    SearchByDateAjax(
        "inventory/adjustment/negative/seaarch",
        ShowAdvertisementInfo,
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
