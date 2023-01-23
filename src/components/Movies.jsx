import DataTable from "react-data-table-component";
import MovieDetails from "./MovieDetails";
import { Paginator } from './Paginator'
import { Selector } from "./Selector";

export const Movies =  ({movies}) => {
	const columns = [
		{
		  name: "Title",
		  selector: (row) => row.title,
		  sortable: true
		},
		{
		  name: "Director",
		  selector: (row) => row.director,
		  sortable: true
		},
		{
		  name: "Runtime (m)",
		  selector: (row) => row.runtime,
		  sortable: false,
		},
		{
		  button: true,
		  cell: (row) => (
			<MovieDetails movie={row}/>
		  )
		}
	];

	return (
		<DataTable			
			columns={columns}
			data={movies}
			defaultSortFieldID={1}
			pagination
			paginationComponent={Paginator}
			selectableRows
          	selectableRowsComponent={Selector}
		/>
	);
};