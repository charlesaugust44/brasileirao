function loadTableData() {
    $(".dataRow").remove();
    $("#loading").fadeIn();

    $.ajax({
        url: '/api/times/classificados',
        method: 'GET',
        timeout: 15000,
        success: function (data) {
            $("#loading").fadeOut();

            if (data.length === 0) {
                $("#nodata").fadeIn();
                return;
            }

            generateTableLines(data);
        },
        error: function (data) {
            $("#tableAlert").fadeIn();
        },
    });
}

function generateTableLines(data) {
    data.forEach(function (v, i, a) {
        let el = $("<tr></tr>");

        let marcador = "";

        if (i === 0)
            marcador = "time-campeao";
        else if (i >= 1 && i <= 6)
            marcador = "time-libertadores";
        else if (i >= 7 && i <= 13)
            marcador = "time-sulamericana";
        else if (i > 16)
            marcador = "time-rebaixado";

        el.addClass(["dataRow", marcador]).attr('id', 'time-' + v.id)
            .append(
                $("<td></td>").append(
                    $("<img/>").attr('src', v.brasao.substr(6))
                ).append(
                    $("<span></span>").text(v.nome)
                )
            )

            .append($("<td></td>").text(v.pontos).addClass("fw-bold"))
            .append($("<td></td>").text(v.confrontos.length))
            .append($("<td></td>").text(v.vitorias))
            .append($("<td></td>").text(v.empates))
            .append($("<td></td>").text(v.derrotas))
            .append($("<td></td>").text(v.gols_pro))
            .append($("<td></td>").text(v.gols_contra))
            .append($("<td></td>").text(v.saldo_gols))

        $("#tableData").append(el);
    })
}

$("#timeCasa").change(function () {
    $("#timeVisitante option").removeAttr("disabled");
    $("#timeVisitante option[value='" + $(this).val() + "']").attr("disabled", "disabled");
});

$("#timeVisitante").change(function () {
    $("#timeCasa option").removeAttr("disabled");
    $("#timeCasa option[value='" + $(this).val() + "']").attr("disabled", "disabled");
});

$("#saveConfronto").click(function () {
    $("#loadingSave").fadeIn();

    $.ajax({
        url: "/api/confrontos",
        method: "POST",
        data: {
            gols_casa: $("#golsCasa").val(),
            gols_visitante: $("#golsVisitante").val(),
            time_casa: $("#timeCasa").val(),
            time_visitante: $("#timeVisitante").val(),
        },
        success: function (data) {
            $("#golsCasa").val("");
            $("#golsVisitante").val("");
            $("#timeCasa").val("");
            $("#timeVisitante").val("");

            $("#loadingSave").fadeOut();
            $("#closeModal").click();
            loadTableData();
        },
        error: function (data) {
            $("#loadingSave").fadeOut();

            $("#modalAlert").html(
                "- " + data.responseJSON.errors.gols_casa + "<br>" +
                "- " + data.responseJSON.errors.gols_visitante + "<br>" +
                "- " + data.responseJSON.errors.time_casa_id + "<br>" +
                "- " + data.responseJSON.errors.time_visitante_id
            ).fadeIn();
        }
    })
});

loadTableData();
