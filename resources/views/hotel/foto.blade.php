        @if($base64Image)
            <img src="data:image/png;base64,{{ $base64Image }}" alt="Imagen Principal del Hotel">
        @else
            <p>No hay foto disponible para este hotel.</p>
        @endif
   

