// $(document).ready(function () {
//     $.ajaxSetup({
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//         },
//     });

//     $("#search-form").on("submit", function (e) {
//         e.preventDefault();
//         var formData = $(this).serialize();
//         $.ajax({
//             url: $(this).attr("action"), // Get form action attribute
//             method: $(this).attr("method"), // Get form method attribute
//             data: formData, // Send serialized form data
//             success: function (response) {
//                 $("#main-content").hide();
//                 $("#search_result").html(response);
//             },
//         });
//     });
// });
