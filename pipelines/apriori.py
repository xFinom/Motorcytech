import pandas as pd
from mlxtend.frequent_patterns import apriori

# --- Load CSVs ---
service_orders_df = pd.read_csv('service_orders_2.csv', parse_dates=['entry_date'])
motorcycles_df = pd.read_csv('motorcycles.csv')
motorcycle_types_df = pd.read_csv('motorcycle_types.csv')
brands_df = pd.read_csv('brands.csv')
spare_parts_df = pd.read_csv('service_orders_spare_parts.csv', parse_dates=['created_at', 'updated_at'])

# --- Merge motorcycles → types → brands to get brand_name ---
motorcycles_df = motorcycles_df.merge(
    motorcycle_types_df[['id', 'brand_id']],
    left_on='type_id',
    right_on='id',
    suffixes=('', '_type')
)
motorcycles_df = motorcycles_df.merge(
    brands_df[['id', 'brand_name']],
    left_on='brand_id',
    right_on='id',
    suffixes=('', '_brand')
)

# --- Merge service orders with motorcycles to get brand_name ---
service_orders_df = service_orders_df.merge(
    motorcycles_df[['id', 'brand_name']],
    left_on='motorcycle_id',
    right_on='id',
    how='left',
    suffixes=('', '_motorcycle')
)

# --- Keep only Reparación service orders (service_id == 2) ---
reparacion_orders = service_orders_df[service_orders_df['service_id'] == 2].copy()
reparacion_orders = reparacion_orders.rename(columns={'id': 'service_order_id'})

# --- Merge spare parts for those orders ---
reparacion_parts = reparacion_orders.merge(
    spare_parts_df[['service_order_id', 'name']],
    on='service_order_id',
    how='left'
)

# --- Create combined brand + spare part field ---
reparacion_parts['brand_part'] = reparacion_parts['brand_name'] + " - " + reparacion_parts['name']

# --- Group transactions by service order ---
transactions = reparacion_parts.groupby('service_order_id')['brand_part'].apply(lambda x: x.dropna().tolist())

# --- One-hot encode transactions ---
all_items = sorted(set(item for sublist in transactions for item in sublist))
encoded_vals = []
for transaction in transactions:
    row = {item: (1 if item in transaction else 0) for item in all_items}
    encoded_vals.append(row)
basket_df = pd.DataFrame(encoded_vals, dtype=bool)
basket_df.to_csv('basket.csv', index=False)
print(f"✅ Basket saved to 'basket.csv' with shape {basket_df.shape}")

# --- Run Apriori to find frequent itemsets ---
frequent_itemsets = apriori(basket_df, min_support=0.01, use_colnames=True)
frequent_itemsets['length'] = frequent_itemsets['itemsets'].apply(lambda x: len(x))

if frequent_itemsets.empty:
    print("⚠️ No frequent itemsets found. Try lowering min_support.")
else:
    # --- Save all frequent itemsets ---
    frequent_itemsets.to_csv('frequent_itemsets.csv', index=False)
    print("✅ Frequent itemsets saved to 'frequent_itemsets.csv'")

    # --- Show top 10 by support ---
    print("Top 10 frequent itemsets by support:")
    print(frequent_itemsets.sort_values(by='support', ascending=False).head(10))

    # --- Optionally, view by size ---
    print("\nFrequent 2-item sets:")
    print(frequent_itemsets[frequent_itemsets['length'] == 2].sort_values(by='support', ascending=False).head(10))
    frequent_itemsets[frequent_itemsets['length'] == 2].to_csv('frequent_itemsets.csv', index=False)

    print("\nFrequent 3-item sets:")
    print(frequent_itemsets[frequent_itemsets['length'] == 3].sort_values(by='support', ascending=False).head(10))
