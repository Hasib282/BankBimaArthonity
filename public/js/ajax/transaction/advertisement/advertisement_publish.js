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
        { label: "Publication Date", key: "publication_date" },
        { label: "Client id", key: "client_id" },
        { label: "Title", key: "title" },
        { label: "Caption", key: "caption" },
        { label: "Category", key: "category" },
        { label: "Page NO", key: "page_no" },
        { label: "Column Inch", key: "column_inch" },
        { label: "Action", type: "button" },
    ]);

    GetTransactionWith("2", "Receive", "#within");

    // Load Transaction Groupe
    GetTransactionGroupe(1, "Receive");

    // Load Data on Hard Reload
    ReloadData("advertise/publish", ShowAdvertisementInfo);

    // Add Modal Open Functionality
    AddModalFunctionality("#date");

    // Insert Ajax
    InsertAjax("advertise/publish", {client: { selector: "#user", attribute: "data-id" }, head: { selector: "#head", attribute: "data-id" }, groupe: { selector: "#head", attribute: "data-groupe" }});

    //Edit Ajax
    EditAjax(EditFormInputValue);

    // Update Ajax
    UpdateAjax("advertise/publish", { location: { selector: '#updateLocation', attribute: 'data-id' } });

    // Delete Ajax
    DeleteAjax("advertise/publish");

    // Delete status bAjax
    DeleteStatusAjax("advertise/publish");

    // Search By Date Ajax
   /* SearchByDateAjax(
        "inventory/adjustment/negative/seaarch",
        ShowAdvertisementInfo,
        { type: 5, method: "Negative" }
    );*/

    // Additional Edit Functionality
    function EditFormInputValue(item) {
        console.log(item);
        $("#id").val(item.id);
        $("#updatepublication_date").val(item.publication_date);
        $("#updateuser").val(item.client_id);
        $("#updatetitle").val(item.title);
        $("#updatecaption").val(item.caption);
        $("#updatecategory").val(item.category);
        $("#updatepage_no").val(item.page_no);
        $("#updatecolumn_inch").val(item.column_inch);
        $("#updatetype").val(item.type);
        $("#updatediscount").val(item.discount);


    }


    // Get Payment Method
    GetSelectInputList('admin/payment_method/get', function (res) {
        CreateSelectOptions('#payment_method', 'Select Payment Method', res.data, 'name');
        CreateSelectOptions('#updatePayment_method', 'Select Payment Method', res.data, 'name');
    })
});
