import pandas as pd
import numpy as np
from sklearn.linear_model import LinearRegression

service_order_df = pd.read_csv('service_orders.csv', parse_dates=['entry_date'])

SERVICE_CATALOG = {
    1: "Mantenimiento Preventivo",
    2: "Reparación",
    3: "Enderezado de Pipas",
    4: "Escaneo",
    5: "Carburación y Fuel Injection",
    6: "Revisión General"
}

service_order_df['service_name'] = service_order_df['service_id'].map(SERVICE_CATALOG)
service_order_df['month'] = service_order_df['entry_date'].dt.to_period('M')

service_order_df = service_order_df[service_order_df['entry_date'].dt.year.isin([2023, 2024])]

monthly_demand = service_order_df.groupby(['month', 'service_name']).size().reset_index(name='count')
monthly_pivot = monthly_demand.pivot(index='month', columns='service_name', values='count').fillna(0)

X = np.arange(len(monthly_pivot)).reshape(-1, 1)

forecast_dict = {}
for service in monthly_pivot.columns:
    y = monthly_pivot[service].values
    model = LinearRegression()
    model.fit(X, y)

    X_future = np.arange(len(X), len(X) + 12).reshape(-1, 1)
    y_future = model.predict(X_future)
    forecast_dict[service] = np.maximum(0, np.round(y_future))

future_months = pd.period_range(monthly_pivot.index[-1] + 1, periods=12, freq='M')
forecast_df = pd.DataFrame(forecast_dict, index=future_months)
forecast_df.index.name = 'month'

actuals_2025 = pd.read_csv('service_orders.csv', parse_dates=['entry_date'])
actuals_2025['service_name'] = actuals_2025['service_id'].map(SERVICE_CATALOG)
actuals_2025['month'] = actuals_2025['entry_date'].dt.to_period('M')
actuals_2025 = actuals_2025[actuals_2025['entry_date'].dt.year == 2025]

monthly_actual_2025 = actuals_2025.groupby(['month', 'service_name']).size().reset_index(name='count')
monthly_actual_pivot_2025 = monthly_actual_2025.pivot(index='month', columns='service_name', values='count').fillna(0)

comparison_df = forecast_df.iloc[:3].merge(
    monthly_actual_pivot_2025,
    left_index=True,
    right_index=True,
    how='left',
    suffixes=('_forecast', '_actual')
)

forecast_df.to_csv('forecast_service_demand_2025.csv')
comparison_df.to_csv('forecast_vs_actual_2025_Q1.csv')
print("Forecast and comparison saved.")


