import Dropdown from 'flarum/common/components/Dropdown';
import app from 'flarum/forum/app';
import IndexPage from 'flarum/forum/components/IndexPage';
import { override } from 'flarum/common/extend';
import ItemList from 'flarum/common/utils/ItemList';
import Button from 'flarum/common/components/Button';

app.initializers.add('blomstra/save-sorting-preferences', () => {
  let sort = app.search.params().sort;

  if (!sort) {
    m.request({
      method: 'GET',
      url: '/api/sorting-preference',
    }).then((response) => {
      sort = response.data.attributes.sort;

      m.redraw();
    });
  }

  override(IndexPage.prototype, 'viewItems', function (this, user) {
    const items = new ItemList();
    const sortMap = app.discussions.sortMap();

    const sortOptions = Object.keys(sortMap).reduce((acc: any, sortId) => {
      acc[sortId] = app.translator.trans(`core.forum.index_sort.${sortId}_button`);
      return acc;
    }, {});

    items.add(
      'sort',
      <Dropdown
        buttonClassName="Button"
        label={sortOptions[sort] || Object.keys(sortMap).map((key) => sortOptions[key])[0]}
        accessibleToggleLabel={app.translator.trans('core.forum.index_sort.toggle_dropdown_accessible_label')}
      >
        {Object.keys(sortOptions).map((value) => {
          const label = sortOptions[value];
          const active = (sort || Object.keys(sortMap)[0]) === value;

          return (
            <Button icon={active ? 'fas fa-check' : true} onclick={app.search.changeSort.bind(app.search, value)} active={active}>
              {label}
            </Button>
          );
        })}
      </Dropdown>
    );

    return items;
  });
});
