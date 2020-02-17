{{-- 
    we require the following vars:
        $details - the details of the book from openlibrary
        $field - the field in $details to try and display
        $label - the label to display in the th cell
--}}
@isset ($details->{$field})
    @php
        $resultStr = '';
        foreach($details->{$field} as $element) {
            $resultStr .= $element->name . ', ';
        }
        $resultStr = rtrim($resultStr, ', ');
    @endphp
    <tr>
        <th>{{ $label }}</th>
        <td>{{ $resultStr }}</td>
    </tr>
@endisset
