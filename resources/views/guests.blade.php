@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Guest List</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table style="width: 100%;">
                        <tr class="odd">
                            <th>Guest Name</th>
                            <th>Address</th>
                            <th>Total Expected</th>
                            <th>Attending?</th>
                        </tr>
                        <?php 
                        foreach ($guests as $i => $guest) : 
                            $style = $i%2 === 0 ? 'style="background-color:#ccc;"' : '';
                            $rsvp = $guest->rsvp;
                            $attending = '-';
                            if ($rsvp) {
                                $attending = ($rsvp->total_children > 0 || $rsvp->total_adults > 0) ? 'Yes' : 'No';
                            }

                            $row = '
                                <tr ' . $style . '>
                                    <td>' . $guest->party_name . ' </td>
                                    <td>' . $guest->address . '</td>
                                    <td style="text-align:center;">' . $guest->total_expected . '</td>
                                    <td>' . $attending . '</td>
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
