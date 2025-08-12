function ShowReporterPortal(res) {
    tableInstance = new GenerateTable({
        tableId: "#data-table",
        data: res.data,
        tbody: [
            "reporterinfo.name",
            "title",
            "description",
            "file_upload",
            //{ key: "tran_date", type: "date" },
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
        { label: "Reporter Id", key: "reporterinfo.name" },
        { label: "Title", key: "title" },
        { label: "Description", key: "description" },
        { label: "Upload file", key: "file_upload" },
        { label: "Action", type: "button" },
    ]);

    // Load Transaction Groupe
    GetTransactionGroupe(5);

    // Load Data on Hard Reload
    ReloadData("reporter", ShowReporterPortal);

    // Add Modal Open Functionality
    AddModalFunctionality("#store");

    // Insert Ajax
    InsertAjax("reporter",{reporter: {selector:'#reporter_id', attribute:'data-id'}});

    //Edit Ajax
    EditAjax(EditFormInputValue);

    // Update Ajax
    UpdateAjax("reporter",{reporter: {selector:'#updateReporter_id', attribute:'data-id'}});

    // Delete Ajax
    DeleteAjax("reporter");

    // Delete status bAjax
    DeleteStatusAjax("reporter");

    // Search By Date Ajax
    SearchByDateAjax(
        "reporter",
        ShowReporterPortal,
        { type: 5, method: "Negative" }
    );

    // Additional Edit Functionality
    function EditFormInputValue(item) {
        $("#id").val(item.id);
        $("#updateReporter_id").val(item.reporterinfo.name);
        $("#updateReporter_id").attr('data-id',item.reporterinfo.employee_id);
        $("#updateTitle").val(item.title);
        $("#updateDescription").val(item.description);
        $("updateUpload_file").val(item.file_upload);
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
