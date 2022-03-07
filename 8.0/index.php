<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic php info</title>
    <style>
        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 14px;
        }
        table,
        table th, 
        table td {
            border: solid 1px #aaa;
        }
        table {
            border-collapse: collapse;
        }
        table th,
        table td {
            padding: 10px;
            vertical-align: top;
            text-align: left;
        }

        table td ul {
            list-style: none;
            padding: 0;
            margin-top: 0;
        }

        table td ul li {
            border-bottom: solid 1px #eee;
            padding-top: 3px;
            padding-bottom: 3px;
        }
    </style>
</head>
<body>
    <h1>Basic PHP Info</h1>
    <table>
        <tr>
            <th>PHP Version</th>
            <td><?php echo phpversion(); ?></td>
        </tr>
        <tr>
            <th>Composer location</th>
            <td><?php echo exec('which composer') ?></td>
        </tr>
        <tr>
            <th>Extensions loaded</th>
            <td>
                <ul>
                    <?php
                        foreach (get_loaded_extensions() as $key => $value) {
                            echo "<li>".$value."</li>";
                        }
                    ?>
                </ul>
            </td>
        </tr>
    </table>
</body>
</html>