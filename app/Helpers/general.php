<?php
const PAGINATION_COUNT = 2;

function getFolder(){
    return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
}
