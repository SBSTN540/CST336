  /*global $*/
$(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "api/getCategories.php",
        dataType: "json",
        success: function(data, status) {
        data.forEach(function(key) {
            $("#categories").append("<option value=" + key["catId"] + ">" + key["catName"] + "</option>");
        });
        }
    });

 $("#searchForm").on("click", function(){
    $.ajax({
        type: "GET",
        url: "api/getSearchResults.php",
        dataType: "json",
        data: {
            "product" : $("[name=product]").val(),
            "category" : $("[name=categories]").val(),
            "priceFrom" : $("[name=priceFrom]").val(),
            "priceTo" : $("[name=priceTo]").val(),
            "orderBy" : $("[name=orderBy]:checked").val(),
        },
        success: function(data, status) {
        $("#results").html("<h3> Products Found: </h3>");
            data.forEach(function(key) {
                $("#results").append("<a href='#' class='historyLink' id='" + key['productId'] + "'>History</a> ");
                $("#results").append(key['productName']+ " " +key['productDescription']+ " " +key['price'] + "<br>");
            });
            }
        });
    }); //searchForm

    $(document).on('click', '.historyLink', function(){
        $('#purchaseHistoryModal').modal("show");
            $.ajax({
                type: "GET",
                url: "api/getPurchaseHistory.php",
                dataType: "json",
                data: {"productId" : $(this).attr("id")},
                    success: function(data, status) {
                    if (data.length != 0) { // Checks if the API returned a non-empty list
                    $("#history").html(""); //clears content
                    $("#history").append(data[0]['productName'] + "<br />");
                
                    data.forEach(function(key) {
                        $("#history").append("Purchase Date: " + key['purchaseDate'] + "<br />");
                        $("#history").append("Unit Price: " + key['unitPrice'] + "<br />");
                        $("#history").append("Quantity: " + key['quantity'] + "<br />");
                    });
                    } else {
                            $("#history").html("No purchase history for this item.");
                        }
                    }
                });
            }); //historyLink

});//documentReady