<?php
foreach (glob(__DIR__ . "/../controllers/*.php") as $filename)
{
    require $filename;
}