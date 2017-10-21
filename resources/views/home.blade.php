@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">All Guests</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table>
                        <tr class="odd">
                            <th>Guest Name</th>
                            <th>Address</th>
                            <th>Total Expected</th>
                            <th>RSVP?</th>
                        </tr>
                        <?php 
                        foreach ($guests as $i => $guest) : 
                            $style = $i%2 === 0 ? 'style="background-color:#ccc;"' : '';
                            $rsvp = $guest->rsvp_count > 0 ? 'Yes' : 'No';
                            $row = '
                                <tr ' . $style . '>
                                    <td>' . $guest->party_name . ' </td>
                                    <td>' . $guest->address . '</td>
                                    <td>' . $guest->total_expected . '</td>
                                    <td>' . $rsvp . '</td>
                                </tr>
                                ';

                            echo $row;
                        endforeach;
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
