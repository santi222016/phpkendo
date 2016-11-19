<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Menu Principal</title>
	<link href="css/kendo.common.min.css" rel="stylesheet"/> 
    <link href="css/kendo.default.min.css" rel="stylesheet"/>

	<script src="js/jquery-1.8.0.js" type ="text/javascript" ></script>
    <script src="js/kendo.all.min.js" type ="text/javascript" ></script>
    <script src="js/kendo.web.min.js" type ="text/javascript" ></script>
</head>
<body>
<script type="text/javascript">
	$(document).ready(function () {
tersubmenu = {

        transport: {
                    read:{
                            url: "./data/P_sub_modulo.php"
                    }
        },
        error: function(e) {
            alert("Error: "+e.responseText);
        },
        schema: {
            data: "data",
            model: {
                id: "idsmodulo",
                fields: {
                    Id_modulo: { editable: false },
                    Nomb_Sub_Mod: { validation: { required: true } }
                }
            }
        }
    
    };

    var menu = new kendo.data.HierarchicalDataSource({
        transport: {
            read: {
                url: "./data/P_menu.php"
            }
        },
        schema: {
            data: "data",
            model: {
                id: "idmodulo",
                children:tersubmenu,
                hasChildren: "idmodulo"
            }
        }
    });
    function onExpand(e) {
        datpn = this.dataItem(e.node);
        datpn.loaded(true);
        }
    $("#treeview").kendoTreeView({
        dataSource: menu,
        dataTextField: ["nombmod", "nombsmod"],
        dataUrlField:"url",
        expand: onExpand
    }).data("kendoTreeView");
});
</script>
<table>
	<tr><td colspan="2">PARTE SUPERIOR</td></tr>
	<tr><td>
		<div class="treeview-back">
                    <h3>Mi Sitio Web</h3>

                    <div id="treeview" class="treeview-back"></div>
                    </div>
                </div>
	</td><td></td></tr>
	<tr></tr>
</table>

</body>
</html>