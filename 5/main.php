<form method="get">
    <input type="text" name="name" placeholder="Область">
    <input type="submit" value="Отобразить">
</form>

<?php

require_once 'DataCorrector.php';

$data_corrector = new DataCorrector();
$data_corrector->fix_data();

$statistic = get_statistic($data_corrector->getData());
$date_statistic = get_date_statistic($data_corrector->getData());
$count_statistic = get_count_statistics($data_corrector->getData(), $statistic);

print_one($statistic, $count_statistic, $date_statistic, $data_corrector->getGenderErrors(), $data_corrector->getEmailErrors());

if (trim($_GET['name']) != "")
    create_get_statistic($data_corrector->getData(), $_GET['name']);

function get_statistic($data)
{
    $male = 0;
    $female = 0;

    $male_growth = 0;
    $female_growth = 0;

    $male_weight = 0;
    $female_weight = 0;

    $male_age = 0;
    $female_age = 0;

    foreach ($data as $item) {

        $items = preg_split('#;#', $item);

        if ($items[4] === "male") {
            $male++;
            $male_growth += (int)$items[13];
            $male_weight += (int)$items[12];
            $male_age += get_age($items[9]);
        }

        if ($items[4] === "female") {
            $female++;
            $female_growth += (int)$items[13];
            $female_weight += (int)$items[12];
            $female_age += get_age($items[9]);
        }
    }

    return array(
        "male" => $male,
        "female" => $female,
        "male_growth" => round($male_growth / $male),
        "female_growth" => round($female_growth / $male),
        "male_weight" => round($male_weight / $male),
        "female_weight" => round($female_weight / $female),
        "male_age" => round($male_age / $female),
        "female_age" => round($female_age / $female)
    );
}

function get_count_statistics($data, $statistic)
{
    $male_growth_small = 0;
    $female_growth_small = 0;
    $male_growth_medium = 0;
    $female_growth_medium = 0;
    $male_growth_big = 0;
    $female_growth_big = 0;

    $male_weight_small = 0;
    $female_weight_small = 0;
    $male_weight_medium = 0;
    $female_weight_medium = 0;
    $male_weight_big = 0;
    $female_weight_big = 0;

    $male_age_small = 0;
    $female_age_small = 0;
    $male_age_medium = 0;
    $female_age_medium = 0;
    $male_age_big = 0;
    $female_age_big = 0;

    foreach ($data as $item) {

        $items = preg_split('#;#', $item);

        if ($items[4] === "male") {
            if ($items[13] > $statistic["male_growth"]) {
                $male_growth_big++;
            }

            if ($items[13] == $statistic["male_growth"]) {
                $male_growth_medium++;
            }

            if ($items[13] < $statistic["male_growth"]) {
                $male_growth_small++;
            }

            if ($items[12] > $statistic["male_weight"]) {
                $male_weight_big++;
            }

            if ($items[12] == $statistic["male_weight"]) {
                $male_weight_medium++;
            }

            if ($items[12] < $statistic["male_weight"]) {
                $male_weight_small++;
            }

            if (get_age($items[9]) > $statistic["male_age"]) {
                $male_age_big++;
            }

            if (get_age($items[9]) == $statistic["male_age"]) {
                $male_age_medium++;
            }

            if (get_age($items[9]) < $statistic["male_age"]) {
                $male_age_small++;
            }
        }

        if ($items[4] === "female") {
            if ($items[13] > $statistic["female_growth"]) {
                $female_growth_big++;
            }

            if ($items[13] == $statistic["female_growth"]) {
                $female_growth_medium++;
            }

            if ($items[13] < $statistic["female_growth"]) {
                $female_growth_small++;
            }

            if ($items[12] > $statistic["female_weight"]) {
                $female_weight_big++;
            }

            if ($items[12] == $statistic["female_weight"]) {
                $female_weight_medium++;
            }

            if ($items[12] < $statistic["female_weight"]) {
                $female_weight_small++;
            }

            if (get_age($items[9]) > $statistic["female_age"]) {
                $female_age_big++;
            }

            if (get_age($items[9]) == $statistic["female_age"]) {
                $female_age_medium++;
            }

            if (get_age($items[9]) < $statistic["female_age"]) {
                $female_age_small++;
            }
        }
    }

    return array(
        "male_growth_small" => $male_growth_small,
        "female_growth_small" => $female_growth_small,
        "male_growth_medium" => $male_growth_medium,
        "female_growth_medium" => $female_growth_medium,
        "male_growth_big" => $male_growth_big,
        "female_growth_big" => $female_growth_big,
        "male_weight_small" => $male_weight_small,
        "female_weight_small" => $female_weight_small,
        "male_weight_medium" => $male_weight_medium,
        "female_weight_medium" => $female_weight_medium,
        "male_weight_big" => $male_weight_big,
        "female_weight_big" => $female_weight_big,
        "male_age_small" => $male_age_small,
        "female_age_small" => $female_age_small,
        "male_age_medium" => $male_age_medium,
        "female_age_medium" => $female_age_medium,
        "male_age_big" => $male_age_big,
        "female_age_big" => $female_age_big
    );
}

function get_date_statistic($data)
{
    $d0101 = [];
    $d0701 = [];
    $d1402 = [];
    $d2302 = [];
    $d0803 = [];
    $d0105 = [];
    $d3112 = [];

    foreach ($data as $item) {
        $items = preg_split('#;#', $item);
        $name = $items[1] . " " . $items[3] . " " . $items[2] . " ";
        preg_match('#^[0-9]{1,2}/[0-9]{1,2}#', $items[9], $date);

        if ($date[0] === "1/1") {
            $d0101[] = $name;
        }

        if ($date[0] === "1/7") {
            $d0701[] = $name;
        }

        if ($date[0] === "2/14") {
            $d1402[] = $name;
        }

        if ($date[0] === "2/23") {
            $d2302[] = $name;
        }

        if ($date[0] === "3/8") {
            $d0803[] = $name;
        }

        if ($date[0] === "5/1") {
            $d0105[] = $name;
        }

        if ($date[0] === "12/31") {
            $d3112[] = $name;
        }
    }

    return array(
        "01/01" => $d0101,
        "07/01" => $d0701,
        "14/02" => $d1402,
        "23/02" => $d2302,
        "08/03" => $d0803,
        "01/05" => $d0105,
        "31/12" => $d3112
    );
}

function print_one($statistic, $count_statistic, $date_statistic, $gender_error, $email_errors)
{

    echo "<div style=';display:inline-block;vertical-align:top; margin-right:15px'>";

    echo '<b>Количество ошибок в поле Пол: ' . $gender_error . '</b><br>';
    echo '<b>Количество ошибок в поле Email: ' . $email_errors . '</b><br><br>';

    echo '<b>Количество мужчин: ' . $statistic["male"] . '</b><br>';
    echo '<b>Средний рост: ' . $statistic["male_growth"] . '</b><br>';
    echo 'Ниже среднего роста: ' . $count_statistic["male_growth_small"] . '<br>';
    echo 'Среднего роста: ' . $count_statistic["male_growth_medium"] . '<br>';
    echo 'Выше среднего роста: ' . $count_statistic["male_growth_big"] . '<br><br>';

    echo '<b>Средний вес: ' . $statistic["male_weight"] . '</b><br>';
    echo 'Ниже среднего веса: ' . $count_statistic["male_weight_small"] . '<br>';
    echo 'Среднего веса: ' . $count_statistic["male_weight_medium"] . '<br>';
    echo 'Выше среднего веса: ' . $count_statistic["male_weight_big"] . '<br><br>';

    echo '<b>Средний возраст: ' . $statistic["male_age"] . '</b><br>';
    echo 'Младше среднего возраста: ' . $count_statistic["male_age_small"] . '<br>';
    echo 'Среднего возраста: ' . $count_statistic["male_age_medium"] . '<br>';
    echo 'Старше среднего возраста: ' . $count_statistic["male_age_big"] . '<br><br>';

    echo '<b>Количество женщин: ' . $statistic["female"] . '</b><br>';
    echo '<b>Средний рост: ' . $statistic["female_growth"] . '</b><br>';
    echo 'Ниже среднего роста: ' . $count_statistic["female_growth_small"] . '<br>';
    echo 'Среднего роста: ' . $count_statistic["female_growth_medium"] . '<br>';
    echo 'Выше среднего роста: ' . $count_statistic["female_growth_big"] . '<br><br>';

    echo '<b>Средний вес: ' . $statistic["female_weight"] . '</b><br>';
    echo 'Ниже среднего веса: ' . $count_statistic["female_weight_small"] . '<br>';
    echo 'Среднего веса: ' . $count_statistic["female_weight_medium"] . '<br>';
    echo 'Выше среднего веса: ' . $count_statistic["female_weight_big"] . '<br><br>';

    echo '<b>Средний возраст: ' . $statistic["female_age"] . '</b><br>';
    echo 'Младше среднего возраста: ' . $count_statistic["female_age_small"] . '<br>';
    echo 'Среднего возраста: ' . $count_statistic["female_age_medium"] . '<br>';
    echo 'Старше среднего возраста: ' . $count_statistic["female_age_big"] . '<br>';

    print_date_statistic($date_statistic, '01/01');
    print_date_statistic($date_statistic, '07/01');
    print_date_statistic($date_statistic, '14/02');
    print_date_statistic($date_statistic, '23/02');
    print_date_statistic($date_statistic, '08/03');
    print_date_statistic($date_statistic, '01/05');
    print_date_statistic($date_statistic, '31/12');

    echo "</div>";

}

function print_date_statistic($date_statistic, $id)
{
    echo '<b><br>Рождённые ' . $id . ':</b><br>';
    foreach ($date_statistic[$id] as $name) {
        echo $name . '<br>';
    }
}

function create_get_statistic($data, $region)
{

    $result = [];

    foreach ($data as $item) {

        $items = preg_split('#;#', $item);
        $color = '';
        if ($items[6] === $region) {
            if ($items[4] === "male") {
                $color = 'blue';
            }

            if ($items[4] === "female") {
                $color = 'pink';
            }

            $name = $items[1] . " " . $items[2] . " " . $items[3];
            $all = $items[4] . " " . $items[5] . " " . $items[6] . " " . $items[7] . " " . $items[8] . " " . get_age($items[9]) . " " . $items[10] . " " . $items[11] . " " . $items[12] . " " . $items[13] . " " . (str_replace(" ", "", $items[14])) . " " . $items[15] . " " . $items[16];

            $result[] = array($items[3], $name, $all, $color);
        }
    }

    uasort($result, 'cmp_function');

    echo "<div style=';display:inline-block;'>";


    foreach ($result as $item) {
        echo "<div style='color:$item[3];display:inline-block;'>$item[1]</div>" . ' ' . $item[2] . "<br>";
    }

    echo "</div>";

}

function cmp_function($a, $b)
{
    return ($a[0] > $b[0]);
}

function get_age($birthday)
{
    $now = time();
    $your_date = strtotime($birthday);
    $date_diff = $now - $your_date;

    return floor($date_diff / (60 * 60 * 24 * 365));
}