   <!DOCTYPE html>
   <html>

   <head>
       <title>Teacher Attendance Report</title>
       <style>
           table {
               width: 100%;
               border-collapse: collapse;
           }

           th,
           td {
               border: 1px solid black;
               padding: 8px;
               text-align: left;
           }

           th {
               background-color: #f2f2f2;
               font-size: 12px;
           }

           td {
               font-size: 10px;
           }

           body {
               font-family: 'Arial', sans-serif;
           }

           h1 {
               font-size: 24px;
           }
       </style>
   </head>

   <body>
       <h1>Rapport Mensuel pour {{ $teacherName }}</h1>
       <table>
           <thead>
               <tr>
                   <th>{{ __('Date') }}</th>
                   <th>{{ __('Début de séance') }}</th>
                   <th>{{ __('Fin de séance') }}</th>
                   <th>{{ __('État') }}</th>
                   <th>{{ __('Justification') }}</th>
               </tr>
           </thead>
           <tbody>
               @forelse ($attendanceRecords as $record)
                   @foreach ($record->attendanceResults as $attendanceResult)
                       <tr>
                           <td>{{ $record->day_date }}</td>
                           <td>{{ $record->class_time_from }}</td>
                           <td>{{ $record->class_time_to }}</td>
                           <td>{{ ucfirst($attendanceResult->attendance_state) }}</td>
                           <td>
                               @if (strtolower($attendanceResult->attendance_state) == 'absent' && $attendanceResult->justification == 1)
                                   Justifié
                               @elseif(strtolower($attendanceResult->attendance_state) == 'absent' &&
                                       ($attendanceResult->justification == null || $attendanceResult->justification == 0))
                                   Non Justifié
                               @elseif(strtolower($attendanceResult->attendance_state) == 'present')
                                   Déjà Présent
                               @else
                                   {{ ucfirst($attendanceResult->justification) }}
                               @endif
                           </td>
                       </tr>
                   @endforeach
               @empty
                   <tr>
                       <td colspan="5" class="text-center">{{ __('Aucun enregistrement trouvé') }}</td>
                   </tr>
               @endforelse
           </tbody>
       </table>
   </body>

   </html>
