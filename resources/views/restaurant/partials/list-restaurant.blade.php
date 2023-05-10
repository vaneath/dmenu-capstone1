<section>
    <table>
        <tr>
            @foreach ($restaurant_columns as $restaurant_column)
                <th style="text-align: center;">{{ $restaurant_column }}</th>
            @endforeach
        </tr>
        @foreach ($restaurants as $restaurant)
            <tr>
                @foreach ($restaurant_columns as $restaurant_column)
                    <td style="text-align: center;">{{ $restaurant->$restaurant_column }}</td>
                @endforeach
            </tr>
        @endforeach
    </table>
</section>
