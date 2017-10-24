@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Rsvps</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table style="width: 100%;">
                        <tr class="odd">
                            <th>Guest Name</th>
                            <th>Attending?</th>
                            <th>Phone Number</th>
                            <th>Total Adults</th>
                            <th>Total Children</th>
                            <!-- <th>Link</th> -->
                        </tr>
                        <?php 
                        foreach ($rsvps as $i => $rsvp) : 
                            $style = $i%2 === 0 ? 'style="background-color:#ccc;"' : '';
                            $guest = $rsvp->guest;
                            $name = $guest ? $guest->party_name : $rsvp->guest_name;
                            $attending = $rsvp->total_children || $rsvp->total_adults > 0 ? 'Yes' : 'No';
                            $row = '
                                <tr ' . $style . '>
                                    <td>' . $name . ' </td>
                                    <td>' . $attending . ' </td>
                                    <td>' . $rsvp->phone . '</td>
                                    <td>' . $rsvp->total_adults . '</td>
                                    <td>' . $rsvp->total_children . '</td>
                                    <!-- <td><a href="{{ route(\'rsvps/edit\') }}">Link to guest</a> -->
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
