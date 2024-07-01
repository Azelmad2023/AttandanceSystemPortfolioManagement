   <!DOCTYPE html>
   <html>

   <head>
       <title>Month Attendance Report</title>
       <style>
           table {
               width: 100%;
               border-collapse: collapse;
           }

           th,
           td {
               border: 1px solid black;
               padding: 4px;
               text-align: left;
           }

           td {
               font-size: 10px;
           }

           th {
               background-color: #f2f2f2;
               font-size: 12px;
           }

           body {
               font-family: 'Arial', sans-serif;
               /* Changed font family to Arial */
           }

           h1 {
               font-size: 24px;
           }
       </style>
   </head>

   <body>
       <h1>Rapport de Présence Mensuel - {{ \Carbon\Carbon::createFromDate($year, $month)->isoFormat('MMMM YYYY') }}
       </h1>
       <table>
           <thead>
               <tr>
                   <th>{{ __('Date') }}</th>
                   <th>{{ __('Nom') }}</th>
                   <th>{{ __('Début de séance') }}</th>
                   <th>{{ __('Fin de séance') }}</th>
                   <th>{{ __('Groupe') }}</th>
                   <th>{{ __('État') }}</th>
                   <th>{{ __('Justification') }}</th>
               </tr>
           </thead>
           <tbody>
               @forelse ($attendanceRecords as $record)
                   @foreach ($record->attendanceResults as $attendanceResult)
                       <tr>
                           <td>{{ $record->day_date }}</td>
                           <td>{{ $record->teacher_name }}</td>
                           <td>{{ $record->class_time_from }}</td>
                           <td>{{ $record->class_time_to }}</td>
                           <td>{{ $record->class_group }}</td>
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
                       <td colspan="5" class="text-center">{{ __('No records found') }}</td>
                   </tr>
               @endforelse
           </tbody>
       </table>
   </body>

   </html>
