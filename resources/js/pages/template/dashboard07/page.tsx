import { AppSidebar } from "@/components/vendor/dashboard07/app-sidebar"
import { ChartAreaInteractive } from "@/components/vendor/dashboard07/chart-area-interactive"
import { DataTable } from "@/components/vendor/dashboard07/data-table"
import { SectionCards } from "@/components/vendor/dashboard07/section-cards"
import { SiteHeader } from "@/components/vendor/dashboard07/site-header"
import {
  SidebarInset,
  SidebarProvider,
} from "@/components/ui/old/sidebar"

import data from "./data.json"

export default function Page() {
  return (
    <SidebarProvider
      style={
        {
          "--sidebar-width": "calc(var(--spacing) * 72)",
          "--header-height": "calc(var(--spacing) * 12)",
        } as React.CSSProperties
      }
    >
      <AppSidebar variant="inset" />
      <SidebarInset>
        <SiteHeader />
        <div className="flex flex-1 flex-col">
          <div className="@container/main flex flex-1 flex-col gap-2">
            <div className="flex flex-col gap-4 py-4 md:gap-6 md:py-6">
              <SectionCards />
              <div className="px-4 lg:px-6">
                <ChartAreaInteractive />
              </div>
              <DataTable data={data} />
            </div>
          </div>
        </div>
      </SidebarInset>
    </SidebarProvider>
  )
}
