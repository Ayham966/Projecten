using System;
using System.Data;
using System.Data.SqlClient;
using System.Drawing;
using System.Windows.Forms;


namespace Gimpies
{
    public partial class ProductDash : Form
    {
        SqlConnection con = new SqlConnection(@"Data Source=(LocalDB)\MSSQLLocalDB;AttachDbFilename=C:\Users\NOOBMASTER69\Documents\dpGimp.mdf;Integrated Security=True;");
        DataSet DS = new System.Data.DataSet();
        SqlCommand cmd;
        public ProductDash()
        {
            InitializeComponent();
        }

        private void ProductDash_Load(object sender, EventArgs e)
        {

            DisplayProduct();
            btnShowPro.Visible = false;
            RemoveHis.Visible = false;
            labSell.Visible = false;

        }

        private void btnAdd_Click(object sender, EventArgs e)
        {


            if (txtMark.Text != "" && txtColor.Text != "" && txtSize.Text != "" && txtPrice.Text != "" && txtAmount.Text != "")
            {
                for (int i = 0; i < dataGridView.Rows.Count; i++)
                {
                    for (int j = 0; j < dataGridView.Columns.Count; j++)
                    {
                        if (dataGridView.Rows[i].Cells[j].Value != null
                         && (txtMark.Text == dataGridView.Rows[i].Cells[1].Value.ToString()
                              && txtColor.Text == dataGridView.Rows[i].Cells[2].Value.ToString()
                              && txtSize.Text == dataGridView.Rows[i].Cells[3].Value.ToString()

                                )
                            )

                        {

                            MessageBox.Show("The Product already existed in Product!.");
                            return;
                        }


                    }



                }
                cmd = new SqlCommand("insert into Product(Mark,Color,Size,Price,Amount) values(@Mark,@Color,@Size,@Price,@Amount)", con);
                con.Open();
                cmd.Parameters.AddWithValue("@Mark", txtMark.Text);
                cmd.Parameters.AddWithValue("@Color", txtColor.Text);
                cmd.Parameters.AddWithValue("@Size", txtSize.Text);
                cmd.Parameters.AddWithValue("@Price", txtPrice.Text + "$");
                cmd.Parameters.AddWithValue("@Amount", txtAmount.Text);
                cmd.ExecuteNonQuery();
                con.Close();
                MessageBox.Show("Added Successfully");
                DisplayProduct();
                ClearData();
            }
            else
            {
                MessageBox.Show("Please full all Details!");
            }
        }

        private void DisplayProduct()
        {
            dataGridView.DataSource = null;
            dataGridView.Columns.Clear();
            con.Open();
            DataTable dt = new DataTable();
            SqlDataAdapter adapt = new SqlDataAdapter("select * from Product", con);
            adapt.Fill(dt);
            dataGridView.DataSource = dt;
            dataGridView.Columns["Id"].Visible = false;
            con.Close();
            foreach (DataGridViewRow row in dataGridView.Rows)
                if (Convert.ToInt32(row.Cells[5].Value) < 10)
                {
                    row.DefaultCellStyle.BackColor = Color.Red;
                }
            foreach (DataGridViewRow row in dataGridView.Rows)
                if (Convert.ToInt32(row.Cells[5].Value) < 5)
                {
                    MessageBox.Show("Warning Product are almost Empty!");
                    return;
                }
            for (int i = 0; i < dataGridView.Columns.Count; i++)
            {
                int col = dataGridView.Columns[i].Width;
                dataGridView.Columns[i].AutoSizeMode = DataGridViewAutoSizeColumnMode.Fill;

                dataGridView.Columns[i].Width = col;
            }
            dataGridView.Columns["Id"].Visible = false;

        }

        private void ClearData()
        {
            txtMark.Text = "";
            txtColor.Text = "";
            txtSize.Text = "";
            txtPrice.Text = "";
            txtAmount.Text = "";

        }

        private void btnRemove_Click(object sender, EventArgs e)
        {

            foreach (DataGridViewRow item in this.dataGridView.SelectedRows)
            {
                cmd = con.CreateCommand();
                int id = Convert.ToInt32(dataGridView.SelectedRows[0].Cells[0].Value);
                cmd.CommandText = "Delete from Product where id='" + id + "'";
                dataGridView.Rows.RemoveAt(this.dataGridView.SelectedRows[0].Index);
                con.Open();
                cmd.ExecuteNonQuery();
                con.Close();
                MessageBox.Show("Product is deleted Successfully");
            }
            ClearData();
        }

        private void txtSize_TextChanged(object sender, EventArgs e)
        {
            if (System.Text.RegularExpressions.Regex.IsMatch(txtSize.Text, "[^0-9]"))
            {
                MessageBox.Show("Please enter only numbers.");
                txtSize.Text = txtSize.Text.Remove(txtSize.Text.Length - 1);
            }
        }

        private void txtPrice_TextChanged(object sender, EventArgs e)
        {

        }
        private void txtAmount_TextChanged(object sender, EventArgs e)
        {
            if (System.Text.RegularExpressions.Regex.IsMatch(txtAmount.Text, "[^0-9]"))
            {
                MessageBox.Show("Please enter " +
                    "only numbers.");
                txtAmount.Text = txtAmount.Text.Remove(txtAmount.Text.Length - 1);
            }
        }

        private void btnUpdate_Click(object sender, EventArgs e)
        {


            int id = Convert.ToInt32(dataGridView.SelectedRows[0].Cells[0].Value);
            if (txtMark.Text != "" && txtColor.Text != "" && txtSize.Text != "" && txtPrice.Text != "" && txtAmount.Text != "")
            {
                cmd = new SqlCommand("update Product set Mark=@Mark,Color=@Color,Size=@Size,Price=@Price,Amount=@Amount where ID=@id", con);
                con.Open();
                cmd.Parameters.AddWithValue("@id", id);
                cmd.Parameters.AddWithValue("@Mark", txtMark.Text);
                cmd.Parameters.AddWithValue("@Color", txtColor.Text);
                cmd.Parameters.AddWithValue("@Size", txtSize.Text);
                cmd.Parameters.AddWithValue("@Price", txtPrice.Text + "$");
                cmd.Parameters.AddWithValue("@Amount", txtAmount.Text);
                cmd.ExecuteNonQuery();
                MessageBox.Show("Updated Successfully");
                con.Close();

                DisplayProduct();
                ClearData();
            }
            else
            {
                MessageBox.Show("Please Select Product to Update");
            }
        }

        private void btnBack_Click(object sender, EventArgs e)
        {
            this.Hide();
            var back = new adminDash();
            back.ShowDialog();
            this.Close();
        }

        private void dataGridView_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {
            ClearData();

            if (labMark.Visible == true)
            {
                txtMark.Text = this.dataGridView.CurrentRow.Cells[1].Value.ToString();
                txtColor.Text = this.dataGridView.CurrentRow.Cells[2].Value.ToString();
                txtSize.Text = this.dataGridView.CurrentRow.Cells[3].Value.ToString();
                // this.txtPrice.Text.Remove(txtPrice.Text.Length - 1);
                string price = this.dataGridView.CurrentRow.Cells[4].Value.ToString();
                price = price.Remove(price.Length - 1);
                txtPrice.Text = price;

                txtAmount.Text = this.dataGridView.CurrentRow.Cells[5].Value.ToString();

            }






        }

        private void btnHistory_Click(object sender, EventArgs e)
        {
            labSell.Text = "Amount sells of this week:";

            dataGridView.DataSource = null;
            dataGridView.Columns.Clear();
            HideCon();
            con.Open();
            DataTable dt = new DataTable();
            SqlDataAdapter adapt = new SqlDataAdapter("select id,Mark,Color,Size,Price,Amount from History", con);
            adapt.Fill(dt);
            dataGridView.DataSource = dt;
            dataGridView.Columns["Id"].Visible = false;
            con.Close();
            for (int i = 0; i < dataGridView.Columns.Count; i++)
            {
                int col = dataGridView.Columns[i].Width;
                dataGridView.Columns[i].AutoSizeMode = DataGridViewAutoSizeColumnMode.Fill;

                dataGridView.Columns[i].Width = col;
            }

            int sum = 0;
            int beste = 0;

            for (int i = 0; i < dataGridView.Rows.Count; ++i)
            {

                sum += Convert.ToInt32(dataGridView.Rows[i].Cells[5].Value);
                if (beste < int.Parse(dataGridView.Rows[i].Cells[5].Value.ToString()))
                {
                    beste = int.Parse(dataGridView.Rows[i].Cells[5].Value.ToString());

                    foreach (DataGridViewRow row in dataGridView.Rows)
                    {            
                        if (Convert.ToInt32(row.Cells[5].Value) == beste)// Or your condition 
                        {
                            row.DefaultCellStyle.BackColor = Color.GreenYellow;
                        }
                        else
                        {
                            row.DefaultCellStyle.BackColor = Color.White;
                        }
                    }


                }
            }
            labSell.Text = labSell.Text + " " + sum.ToString() + " The best was: " + beste;

            }
        
    /*
                foreach ( DataGridView row in dataGridView.Rows)
                if (beste == 7)
                {
                    dataGridView.Rows[i].DefaultCellStyle.BackColor = Color.GreenYellow;
                }
                */


    private void HideCon()
        {
            labMark.Visible = false;
            labColor.Visible = false;
            labSize.Visible = false;
            labPrice.Visible = false;
            labAmount.Visible = false;
            txtMark.Visible = false;
            txtColor.Visible = false;
            txtSize.Visible = false;
            txtPrice.Visible = false;
            txtAmount.Visible = false;
            btnAdd.Visible = false;
            btnRemove.Visible = false;
            labDoll.Visible = false;
            btnUpdate.Visible = false;
            btnShowPro.Visible = true;
            RemoveHis.Visible = true;
            labSell.Visible = true;

        }

        private void btnShowPro_Click(object sender, EventArgs e)
        {
            labMark.Visible = true;
            labColor.Visible = true;
            labSize.Visible = true;
            labPrice.Visible = true;
            labAmount.Visible = true;
            txtMark.Visible = true;
            txtColor.Visible = true;
            txtSize.Visible = true;
            txtPrice.Visible = true;
            txtAmount.Visible = true;
            btnAdd.Visible = true;
            btnRemove.Visible = true;
            labDoll.Visible = true;
            btnUpdate.Visible = true;

            RemoveHis.Visible = false;
            labSell.Visible = false;

            dataGridView.DataSource = null;
            dataGridView.Columns.Clear();
            DisplayProduct();

        }

        private void RemoveHis_Click(object sender, EventArgs e)
        {

            foreach (DataGridViewRow item in this.dataGridView.SelectedRows)
            {
                cmd = con.CreateCommand();
                int id = Convert.ToInt32(dataGridView.SelectedRows[0].Cells[0].Value);
                cmd.CommandText = "Delete from History where id='" + id + "'";
                dataGridView.Rows.RemoveAt(this.dataGridView.SelectedRows[0].Index);
                con.Open();
                cmd.ExecuteNonQuery();
                con.Close();
                MessageBox.Show("Histroy item is deleted Successfully");

            }
        }

        private void Product_Closing(object sender, FormClosingEventArgs e)
        {
            if (e.CloseReason == CloseReason.UserClosing)
            {
                if (MessageBox.Show("Are you sure you want to exit ?", "Confirmation",
                MessageBoxButtons.YesNo, MessageBoxIcon.Question) == DialogResult.Yes)
                { Application.Exit(); }
                else { e.Cancel = true; }
            }
        }
    }
}
