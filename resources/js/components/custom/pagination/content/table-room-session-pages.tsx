// import React from 'react';
// import { usePage, router } from '@inertiajs/react';
import {
    flexRender,
    getCoreRowModel,
    useReactTable,
} from '@tanstack/react-table';

import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'; // Adjust path to your UI components
// import { Button } from '@/components/ui/button'; // Adjust path
import { PaginationComponentProps, RoomSession } from '@/types';

// Define your columns
// This can be in a separate file, e.g., columns.jsx
export const columns = [
    {
        accessorKey: 'id',
        header: 'ID',
    },
    {
        accessorKey: 'room_session_start',
        header: 'Start Time',
    },
    {
        accessorKey: 'room_session_end',
        header: 'End Time',
    },
];

export default function RoomSessionTable({paginator}: PaginationComponentProps<RoomSession>) {
    // 1. Get paginated data from Inertia props
    
    const {
        data, // This is the array of items for the current page
        // meta, // Laravel 10+ uses 'meta' by default for pagination info
        // links // Contains pagination links (previous, next, page numbers)
    } = paginator;

    // For older Laravel versions, you might get these directly
    const currentPage =  paginator.current_page;
    const totalPages =  paginator.last_page;

    // 2. Configure React Table for server-side pagination
    const table = useReactTable({
        data: data, // Use the 'data' array from the paginator
        columns,
        getCoreRowModel: getCoreRowModel(),
        manualPagination: true, // Tell the table we're handling pagination ourselves
        pageCount: totalPages, // Let the table know the total number of pages
        state: {
            pagination: {
                pageIndex: currentPage - 1, // The current page index (0-based)
                pageSize: paginator.per_page, // How many items per page
            },
        },
    });

    return (
        <div className="w-full">
            {/* You can keep your filtering/column visibility UI here */}
            <div className="flex items-center">
                {/* ... your input and dropdown menu ... */}
            </div>

            <div className="overflow-hidden rounded-md border">
                <Table>
                    <TableHeader>
                        {table.getHeaderGroups().map((headerGroup) => (
                            <TableRow key={headerGroup.id}>
                                {headerGroup.headers.map((header) => (
                                    <TableHead key={header.id}>
                                        {header.isPlaceholder
                                            ? null
                                            : flexRender(
                                                  header.column.columnDef.header,
                                                  header.getContext()
                                              )}
                                    </TableHead>
                                ))}
                            </TableRow>
                        ))}
                    </TableHeader>
                    <TableBody>
                        {table.getRowModel().rows?.length ? (
                            table.getRowModel().rows.map((row) => (
                                <TableRow key={row.id}>
                                    {row.getVisibleCells().map((cell) => (
                                        <TableCell key={cell.id}>
                                            {flexRender(
                                                cell.column.columnDef.cell,
                                                cell.getContext()
                                            )}
                                        </TableCell>
                                    ))}
                                </TableRow>
                            ))
                        ) : (
                            <TableRow>
                                <TableCell
                                    colSpan={columns.length}
                                    className="h-24 text-center"
                                >
                                    No results.
                                </TableCell>
                            </TableRow>
                        )}
                    </TableBody>
                </Table>
            </div>
        </div>
    );
}